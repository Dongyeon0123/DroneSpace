<?php
session_start();

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

// 답변 저장
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply'], $_POST['questionid'])) {
    $reply = $_POST['reply'];
    $question_id = $_POST['questionid'];
    $admin_id = $_SESSION['adminid'];  // 세션에서 관리자 ID 가져오기

    $stmt = $conn->prepare("INSERT INTO replies (questionid, reply, adminid) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $question_id, $reply, $admin_id);

    if ($stmt->execute()) {
        echo '<script>alert("답변이 성공적으로 등록되었습니다."); window.location.href="ask.php";</script>';
    } else {
        echo '<script>alert("답변 등록에 실패했습니다."); window.history.back();</script>';
    }
    $stmt->close();
}

$conn->close();
?>
