<?php
session_start();

// PHP 시간대 설정
date_default_timezone_set('Asia/Seoul');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // 로그인 페이지로 리디렉트 전에 JavaScript를 사용하여 경고 메시지 표시
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "skso1951";
$dbname = "dbwork";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// MySQL 시간대 설정
$conn->query("SET time_zone = '+09:00'");

$conn->set_charset("utf8");

// 게시글 저장
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question'])) {
    $username = $_SESSION['memberid'] ?? $_SESSION['adminid']; // 세션에서 사용자 ID 가져오기
    $question = $_POST['question'];

    $stmt = $conn->prepare("INSERT INTO questions (username, question) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $question);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "질문이 성공적으로 등록되었습니다.";
    header("Location: ask.php");
    exit;
}

// 게시글 삭제
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "질문이 성공적으로 삭제되었습니다.";
    header("Location: ask.php");
    exit;
}

// 게시글 불러오기
$questions = [];
$query = "SELECT q.id, q.username, q.question, q.created_at as question_created_at, r.reply, r.adminid, r.created_at as reply_created_at
          FROM questions q 
          LEFT JOIN replies r ON q.id = r.questionid ";

if (!isset($_SESSION['adminid'])) {
    $query .= "WHERE q.username = '" . $conn->real_escape_string($_SESSION['memberid']) . "' ";
}

$query .= "ORDER BY q.created_at DESC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>1대1 질문 게시판</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .main-content {
            padding: 20px;
            background: #fff;
        }
        .main-content h2 {
            margin-top: 0;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea, button {
            display: block;
            margin-top: 5px;
        }
        input.username, textarea.question {
            width: 50%;
        }
        textarea.question {
            width: 50%; /* 질문 입력란의 너비를 줄임 */
        }
        button {
            width: auto;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        #questionList {
            margin-top: 20px;
        }
        .question-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            position: relative;
        }
        .question-item h3 {
            margin: 0 0 10px 0;
        }
        .question-item p {
            margin: 0;
        }
        .delete-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 5px 10px;
        }
        .delete-button:hover {
            background-color: #cc0000;
        }
        .comment-section {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }
        .comment-form {
            margin-top: 10px;
        }
        .comment-form label {
            display: inline-block;
            width: 10%;
            vertical-align: top;
        }
        .comment-form textarea {
            display: inline-block;
            width: 60%;
        }
        .comment-form button {
            display: inline-block;
            width: auto;
            vertical-align: top;
        }
        .comment-list {
            margin-top: 10px;
        }
        .comment {
            margin-top: 10px;
        }
        .footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        .comment-form button {
            margin-top: 10px; /* 댓글 등록 버튼과 입력 칸 사이 간격 증가 */
        }
        .hamburger {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            width: 35px;
            height: 30px;
            cursor: pointer;
            z-index: 1001;
        }
        .hamburger div {
            width: 100%;
            height: 3px;
            background-color: #333;
            transition: all 0.3s ease-in-out;
        }
        .hamburger:hover div:nth-child(1) {
            width: 50%;
        }
        .hamburger:hover div:nth-child(3) {
            width: 50%;
        }
        .menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(1, 161, 91, 0.9), #3b3b3b);
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease-in-out;
            z-index: 1002;
        }

        .close-btn {
            position: absolute;
            top: 40px;
            right: 40px;
            cursor: pointer;
            font-size: 24px;
            color: white;
            z-index: 101;  /* 메뉴 위에 보이도록 z-index 설정 */
        }


        .menu-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .menu-overlay-content {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            padding: 16px 32px;
            margin-top: 50px;
            margin-left: 220px;
            text-align: center;
        }
        .menu-overlay .image-container {
            display: flex;
            justify-content: center; /* 가로 중앙 정렬 */
            width: 100%; /* 부모 컨테이너의 전체 너비 사용 */
        }

        .menu-overlay img {
            width: 320px;
            height: 130px;
            padding: 10px;
            background-color: white;
            border-radius: 8px;
            margin-top: 60px;
        }
        .menu-overlay-content h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 44px;
            color: white;
        }
        .menu-overlay-content ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-overlay-content ul li {
            margin-bottom: 14px;
            font-size: 18px;
        }

        .menu-overlay-content ul li a {
            color: white;
            text-decoration: none;
        }


        .menu-overlay-content ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 7px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<header class="header">
        <a href="main.php"><img src="logo.png"></a>
        <ul class="menu">
        <li>
                기업 소개
                <ul>
                    <a href="hello.php"><li>인사말</li></a>
                    <a href="history.php"><li>DroneSpace 연혁</li></a>
                    <a href="vision.php"><li>아카데미 비전</li></a>
                    <a href="facility.php"><li>시설 현황</li></a>
                    <a href="map.php"><li>오시는 길</li></a>
                </ul>
            </li>
            <li>
                국가 자격증
                <ul>
                    <a href="information.php"><li>국가 자격증 안내</li></a>
                    <a href="money.php"><li>교육비 지원 안내</li></a>
                    <a href="company.php"><li>기관/단체 교육 안내</li></a>
                    <a href="type1.php"><li>1종 조종자 과정</li></a>
                    <a href="type2.php"><li>2종 조종자 과정</li></a>
                    <a href="type3.php"><li>3종 조종자 과정</li></a>
                    <a href="education.php"><li>드론 운용자 교육</li></a>
                    <a href="instructor.php"><li>지도 조종자 과정</li></a>
                    <a href="practical.php"><li>실기 평가자 과정</li></a>
                </ul>
            </li>
            <li>
                구인 & 구직
                <ul>
                    <a href="area.php"><li>지역별</li></a>
                    <a href="certificate.php"><li>자격증별</li></a>
                </ul>
            </li>
            <li>
                <span class="menuli">커뮤니티</span>
                <ul>
                    <a href="everything.php"><li>전체글</li></a>
                    <a href="hot.php"><li>HOT글</li></a>
                    <a href="ask.php"><li>1대1 질문 게시판</li></a>
                </ul>
            </li>
            <li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" style="color: black;">로그아웃</a>
                <?php else: ?>
                    <a href="login.html" style="color: black;">로그인 / 회원가입</a>
                <?php endif; ?>
            </li>
            <li>
                마이 페이지
                <ul>
                    <a href="mywrite.php"><li>내가 작성한 게시글</li></a>
                    <a href="myreply.php"><li>내가 작성한 댓글</li></a>
                    <a href="application.php"><li>구인&구직 신청 현황</li></a>
                    <a href="mycer.php"><li>내 이력서</li></a>
                </ul>
            </li>
        </ul>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>

    <section class="showcase">
        <div class="container">
            <h1>1대1 질문게시판</h1>
        </div>
    </section>

    <section class="main-content container">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert">
                <script>alert("<?php echo $_SESSION['message']; ?>");</script>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <form id="questionForm" method="post" action="ask.php">
            <label for="question">질문:</label>
            <textarea id="question" name="question" required></textarea>
            <button type="submit">질문 등록</button>
        </form>

        <h2>질문 목록</h2>
        <div id="questionList">
            <?php foreach ($questions as $question): ?>
                <div class="question-item">
                    <h3><?php echo htmlspecialchars($question['username']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($question['question'])); ?></p>
                    <p>질문 등록 시간: <?php echo date('Y-m-d H:i', strtotime($question['question_created_at'])); ?></p>
                    <?php if (isset($_SESSION['adminid'])): ?>
                        <!-- 관리자용 답변 입력란 -->
                        <form method="post" action="reply.php">
                            <input type="hidden" name="questionid" value="<?php echo $question['id']; ?>">
                            <textarea name="reply" required></textarea>
                            <button type="submit">답변 등록</button>
                        </form>
                    <?php endif; ?>
                    <?php if (!empty($question['reply'])): ?>
                        <!-- 관리자와 사용자에게 표시되는 답변 -->
                        <div class="admin-reply">
                            <strong>관리자 답변:</strong>
                            <p><?php echo nl2br(htmlspecialchars($question['reply'])); ?></p>
                            <p><strong>답변자:</strong> <?php echo htmlspecialchars($question['adminid']); ?></p>
                            <p>답변 등록 시간: <?php echo date('Y-m-d H:i', strtotime($question['reply_created_at'])); ?></p>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="ask.php" onsubmit="return confirmDelete(this)">
                        <input type="hidden" name="delete_id" value="<?php echo $question['id']; ?>">
                        <button type="submit" class="delete-button">삭제</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


    <footer class="footer">
        <p>&copy; 2024 KDEC 한국드론교육센터. 모든 권리 보유.</p>
    </footer>
    <div class="menu-overlay" id="menuOverlay">
        <div class="image-container">
            <a href="main.php"><img src="logo.png"></a>
        </div>
        <div class="menu-overlay-content">
            <span class="close-btn" onclick="closeMenu()">X</span>
            <div>
                <h2>기업 소개</h2>
                    <ul>
                        <li><a href="hello.php">인사말</a></li>
                        <li><a href="history.php">DroneSpace 연혁</a></li>
                        <li><a href="vision.php">아카데미 비전</a></li>
                        <li><a href="facility.php">시설 현황</a></li>
                        <li><a href="map.php">오시는 길</a></li>
                    </ul>
            </div>
            <div>
                <h2>국가 자격증</h2>
                    <ul>
                        <li><a href="information.php">국가 자격증 안내</a></li>
                        <li><a href="money.php">교육비 지원 안내</a></li>
                        <li><a href="company.php">기관/단체 교육 안내</a></li>
                        <li><a href="type1.php">1종 조종자 과정</a></li>
                        <li><a href="type2.php">2종 조종자 과정</a></li>
                        <li><a href="type3.php">3종 조종자 과정</a></li>
                        <li><a href="education.php">드론 운용자 교육</a></li>
                        <li><a href="instructor.php">지도 조종자 과정</a></li>
                        <li><a href="practical.php">실기 평가자 과정</a></li>
                    </ul>
            </div>
            <div>
                <h2>구인 & 구직</h2>
                    <ul>
                        <li><a href="area.php">지역별</a></li>
                        <li><a href="certificate.php">자격증별</a></li>
                    </ul>
            </div>
            <div>
                <h2 style="color: red;">커뮤니티</h2>
                    <ul>
                        <li><a href="everything.php">전체글</a></li>
                        <li><a href="hot.php">HOT글</a></li>
                        <li><a href="ask.php">1대1 질문 게시판</a></li>
                    </ul>
            </div>
            <div style="margin-top: 24px;">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" style="color: white; font-size: 24px;">로그아웃</a>
                <?php else: ?>
                    <a href="login.html" style="color: white; font-size: 24px;">로그인 / 회원가입</a>
                <?php endif; ?>
            </div>
            <div>
                <h2>마이 페이지</h2>
                    <ul>
                        <li><a href="mywrite.php">내가 작성한 게시글</a></li>
                        <li><a href="myreply.php">내가 작성한 댓글</a></li>
                        <li><a href="application.php">구인&구직 신청 현황</a></li>
                        <li><a href="mycer.php">내 이력서</a></li>
                    </ul>
            </div>
    </div>
        
    <script>
        function confirmDelete(form) {
            if (confirm("삭제하시겠습니까?")) {
                form.onsubmit = function() {
                    alert("질문이 성공적으로 삭제되었습니다.");
                };
                return true;
            } else {
                return false;
            }
        }
        function toggleMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.toggle('show');
        }
        function closeMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.remove('show');  // 'show' 클래스를 제거하여 팝업 숨김
        }
    </script>
</body>
</html>
