<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['postnum']) && isset($_POST['commentcontent'])) {
    $postnum = $_POST['postnum'];
    $commentcontent = $_POST['commentcontent'];
    $memberid = $_SESSION['memberid']; // 사용자 ID는 세션에서 가져옵니다.

    $stmt = $conn->prepare("INSERT INTO commenttbl (postnum, memberid, commentcontent) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $postnum, $memberid, $commentcontent);

    if ($stmt->execute()) {
        // 댓글 작성 성공 시
        echo "<script>alert('댓글이 성공적으로 작성되었습니다.'); window.location.href='post_detail.php?postnum=$postnum';</script>";
    } else {
        // 댓글 작성 실패 시
        echo "<script>alert('댓글 작성에 실패했습니다.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
