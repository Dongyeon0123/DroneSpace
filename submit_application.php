<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.close();</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $memberid = $_SESSION['memberid'];
    $recruitnum = $_POST['recruitnum'];
    $resume_id = $_POST['resume_id'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO applications (recruitnum, memberid, resume_id, message, apply_date) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiss", $recruitnum, $memberid, $resume_id, $message);

    if ($stmt->execute()) {
        echo "<script>alert('신청이 완료되었습니다.'); window.close();</script>";
    } else {
        echo "<script>alert('신청에 실패했습니다.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
