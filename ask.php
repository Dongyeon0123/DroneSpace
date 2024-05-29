<?php
session_start();

// PHP 시간대 설정
date_default_timezone_set('Asia/Seoul');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // 로그인 페이지로 리디렉트 전에 JavaScript를 사용하여 경고 메시지 표시
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

require_once 'db.php';

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

        .close-btn {
            position: absolute;
            top: 40px;
            right: 40px;
            cursor: pointer;
            font-size: 24px;
            color: white;
            z-index: 101;  /* 메뉴 위에 보이도록 z-index 설정 */
        }
    </style>
</head>
<body>
<?php
        require_once "header.php";
    ?>

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
                    <h3><?php echo htmlspecialchars($question['username']); ?></h3><br>
                    <p><?php echo nl2br(htmlspecialchars($question['question'])); ?></p><br>
                    <p>질문 등록 시간: <?php echo date('Y-m-d H:i', strtotime($question['question_created_at'])); ?></p><br><hr><br>
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
                            <strong>관리자 답변:</strong><br><br>
                            <p><?php echo nl2br(htmlspecialchars($question['reply'])); ?></p><br>
                            <p><strong>답변자:</strong> <?php echo htmlspecialchars($question['adminid']); ?></p><br>
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
