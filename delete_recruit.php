<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recruitnum = $_POST['recruitnum'];

    $stmt = $conn->prepare("DELETE FROM recruitment WHERE recruitnum = ? AND memberid = ?");
    $stmt->bind_param("is", $recruitnum, $_SESSION['memberid']);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => '구인글 삭제에 실패했습니다.']);
    }

    $stmt->close();
}

$conn->close();
?>
