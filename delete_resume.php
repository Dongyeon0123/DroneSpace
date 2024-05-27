<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
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

$conn->set_charset("utf8");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resume_id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM resumes WHERE id = ? AND memberid = ?");
    $stmt->bind_param("is", $resume_id, $_SESSION['memberid']);

    if ($stmt->execute()) {
        echo "<script>alert('이력서가 성공적으로 삭제되었습니다.'); window.location.href='mycer.php';</script>";
    } else {
        echo "<script>alert('이력서 삭제에 실패했습니다.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>