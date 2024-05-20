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
        echo "질문이 성공적으로 등록되었습니다.";
    } else {
        echo "질문 등록에 실패했습니다.";
    }

    $stmt->close();
}

// 게시글 삭제
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "질문이 성공적으로 삭제되었습니다.";
    } else {
        echo "질문 삭제에 실패했습니다.";
    }

    $stmt->close();
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
        header {
            background: #333;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #77aaff 3px solid;
        }
        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }
        header ul {
            padding: 0;
            list-style: none;
        }
        header li {
            display: inline;
            padding: 0 20px 0 20px;
        }
        header #branding {
            float: left;
        }
        header #branding h1 {
            margin: 0;
        }
        header nav {
            float: right;
            margin-top: 10px;
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
    </style>
</head>
<body>
    <section class="showcase">
        <div class="container">
            <h1>1대1 질문게시판</h1>
        </div>
    </section>

    <section class="main-content container">
        <form id="questionForm" method="post" action="question_board.php">
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
                    <form method="post" action="question_board.php">
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
</body>
</html>
