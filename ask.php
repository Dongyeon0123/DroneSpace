<?php
// 세션 시작
session_start();

// 로그인 상태 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
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

$conn->set_charset("utf8");

// 게시글 저장
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question'])) {
    $username = $_SESSION['memberid'];
    $question = $_POST['question'];

    $stmt = $conn->prepare("INSERT INTO questions (username, question) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $question);

    if ($stmt->execute()) {
        $_SESSION['message'] = "질문이 성공적으로 등록되었습니다.";
    } else {
        $_SESSION['message'] = "질문 등록에 실패했습니다.";
    }

    $stmt->close();
    header("Location: ask.php");
    exit;
}

// 게시글 삭제
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "질문이 성공적으로 삭제되었습니다.";
    } else {
        $_SESSION['message'] = "질문 삭제에 실패했습니다.";
    }

    $stmt->close();
    header("Location: ask.php");
    exit;
}

// 게시글 불러오기
$questions = [];
$result = $conn->query("SELECT id, username, question, created_at FROM questions ORDER BY created_at DESC");

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
    <title>1대1 질문 게시판</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 7px 35px;
            border-bottom: 2px solid #000;
        }
        .header img {
            width: 200px;
            height: 90px;
            margin: 0;
            margin-left: 100px;
            margin-top: 3px;
        }
        .header a {
            text-decoration: none;
        }
        .menu {
            list-style-type: none;
            padding: 0;
            display: flex;
            font-weight: bold;
            margin-top: 20px;
        }
        .menu li {
            position: relative;
            padding: 10px;
            cursor: pointer;
        }
        .menu li ul {
            position: absolute;
            top: 100%;
            left: 0;
            display: none;
            background-color: rgb(227, 227, 227);
            margin: 0px;
            list-style: none;
            padding: 0;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            border-top: 5px solid rgb(51, 179, 57);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1000; /* Ensures the submenu is above other content */
        }
        .menu li:hover ul {
            display: block;
        }
        .menu li:not(:last-child)::after {
            content: "|";
            color: rgb(156, 154, 154);
            margin-left: 30px;
            margin-right: 20px;
        }
        .menu li ul li:not(:last-child)::after {
            content: none;
        }
        .menu li ul li {
            width: 145px;
            padding: 15px;
            text-align: center;
        }
        .menu li ul li:hover {
            background-color: rgb(51, 179, 57);
            color: white;
        }
        .menu li ul li:last-child {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .menu li ul li a {
            color: black;
            text-decoration: none;
        }
        .menu li ul li a:hover {
            color: white;
        }
        .menu li:last-child a {
            color: black;
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
            background: linear-gradient(to right, rgba(241, 55, 55, 0.8), #3b3b3b);
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease-in-out;
        }
        .menu-overlay.show {
            display: flex;
            opacity: 1;
            visibility: visible;
        }
        .menu-overlay-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            width: 80%;
        }
        .menu-overlay-content ul {
            list-style-type: none;
            padding: 0;
            font-size: 24px;
            margin: 0;
        }
        .menu-overlay-content ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .menu-overlay-content ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
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
                    <li><a href="hello.php">인사말</a></li>
                    <li><a href="#">DroneSpace 연혁</a></li>
                    <li><a href="#">아카데미 비전</a></li>
                    <li><a href="#">인증서</a></li>
                    <li><a href="#">시설 현황</a></li>
                    <li><a href="map.php">오시는 길</a></li>
                </ul>
            </li>
            <li>
                국가 자격증
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
            </li>
            <li>
                구인 & 구직
                <ul>
                    <li><a href="area.php">지역별</a></li>
                    <li><a href="#">자격증별</a></li>
                </ul>
            </li>
            <li>
                드론 관련 기업
                <ul>
                    <li><a href="review.php">기업 리뷰</a></li>
                    <li><a href="#">면접 후기</a></li>
                </ul>
            </li>
            <li>
                커뮤니티
                <ul>
                    <li><a href="everything.php">전체글</a></li>
                    <li><a href="#">HOT글</a></li>
                    <li><a href="#">주제별</a></li>
                    <li><a href="ask.php">1대1 질문 게시판</a></li>
                </ul>
            </li>
            <li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" style="color: black;">로그아웃</a>
                <?php else: ?>
                    <a href="login.html" style="color: black;">로그인 / 회원가입</a>
                <?php endif; ?>
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
                <script>
                    alert("<?php echo $_SESSION['message']; ?>");
                </script>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <form id="questionForm" method="post" action="ask.php">
            <input type="hidden" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION['memberid']); ?>">
            <label for="question">질문:</label>
            <textarea id="question" name="question" class="question" rows="4" required></textarea>
            <button type="submit">질문 등록</button>
        </form>

        <h2>질문 목록</h2>
        <div id="questionList">
            <?php foreach ($questions as $question): ?>
                <div class="question-item">
                    <h3><?php echo htmlspecialchars($question['username']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($question['question'])); ?></p>
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
        <div class="menu-overlay-content">
            <ul>
                <li>기업 소개
                    <ul>
                        <li><a href="hello.html">인사말</a></li>
                        <li><a href="#">DroneSpace 연혁</a></li>
                        <li><a href="#">아카데미 비전</a></li>
                        <li><a href="#">인증서</a></li>
                        <li><a href="#">시설 현황</a></li>
                        <li><a href="#">오시는 길</a></li>
                        <li><a href="#">전체 교육 과정 안내</a></li>
                    </ul>
                </li>
                <li>국가 자격증
                    <ul>
                        <li><a href="nformation.html">국가 자격증 안내</a></li>
                        <li><a href="#">교육비 지원 안내</a></li>
                        <li><a href="#">기관/단체 교육 안내</a></li>
                        <li><a href="type1.html">1종 조종자 과정</a></li>
                        <li><a href="type2.html">2종 조종자 과정</a></li>
                        <li><a href="type3.html">3종 조종자 과정</a></li>
                        <li><a href="#">드론 운용자 교육</a></li>
                        <li><a href="#">지도 조종자 과정</a></li>
                        <li><a href="#">실기 평가자 과정</a></li>
                    </ul>
                </li>
                <li>구인 & 구직
                    <ul>
                        <li><a href="area.html">지역별</a></li>
                        <li><a href="#">자격증별</a></li>
                    </ul>
                </li>
                <li>드론 관련 기업
                    <ul>
                        <li><a href="review.html">기업 리뷰</a></li>
                        <li><a href="#">면접 후기</a></li>
                    </ul>
                </li>
                <li>커뮤니티
                    <ul>
                        <li><a href="everything.html">전체글</a></li>
                        <li><a href="#">HOT글</a></li>
                        <li><a href="#">주제별</a></li>
                        <li><a href="#">1대1 질문 게시판</a></li>
                    </ul>
                </li>
                <li>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                        <a href="logout.php" style="color: black;">로그아웃</a>
                    <?php else: ?>
                        <a href="login.html" style="color: black;">로그인 / 회원가입</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
        
    <script>
        function confirmDelete(form) {
            if (confirm("삭제하시겠습니까?")) {
                // 폼 제출을 허용하고, 삭제 성공 메시지를 표시
                form.onsubmit = function() {
                    alert("질문이 성공적으로 삭제되었습니다.");
                };
                return true;
            } else {
                // 폼 제출을 중단
                return false;
            }
        }
        function toggleMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.toggle('show');
        }
    </script>
</body>
</html>
