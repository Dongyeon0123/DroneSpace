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
    // 현재 시간을 UTC 기준으로 설정합니다. 서버 환경에 따라 이 부분은 조정이 필요할 수 있습니다.
    $created_at = date('Y-m-d H:i:s'); 

    $stmt = $conn->prepare("INSERT INTO questions (username, question, created_at) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $question, $created_at);

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