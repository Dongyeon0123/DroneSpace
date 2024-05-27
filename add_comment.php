<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postnum = $_POST['postnum'];
    $commentcontent = $_POST['commentcontent'];
    $memberid = $_SESSION['memberid'];

    $stmt = $conn->prepare("INSERT INTO commenttbl (postnum, memberid, commentcontent) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $postnum, $memberid, $commentcontent);

    if ($stmt->execute()) {
        echo "<script>alert('댓글이 성공적으로 작성되었습니다.'); window.location.href='post_detail.php?postnum=$postnum';</script>";
    } else {
        echo "<script>alert('댓글 작성에 실패했습니다.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
