<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postnum = $_POST['postnum'];
    $memberid = $_SESSION['memberid'];

    // 게시글 작성자인지 확인
    $sql = "SELECT memberid FROM post WHERE postnum = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postnum);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($post_memberid);
    $stmt->fetch();

    if ($stmt->num_rows === 0 || $post_memberid !== $memberid) {
        echo "<script>alert('삭제 권한이 없습니다.'); window.history.back();</script>";
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    // 좋아요 삭제
    $sql = "DELETE FROM likes WHERE postnum = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postnum);
    $stmt->execute();
    $stmt->close();

    // 댓글 삭제
    $sql = "DELETE FROM commenttbl WHERE postnum = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postnum);
    $stmt->execute();
    $stmt->close();

    // 게시글 삭제
    $sql = "DELETE FROM post WHERE postnum = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postnum);
    if ($stmt->execute()) {
        echo "<script>alert('게시글이 성공적으로 삭제되었습니다.'); window.location.href='everything.php';</script>";
    } else {
        echo "<script>alert('게시글 삭제에 실패했습니다.'); window.history.back();</script>";
    }
    $stmt->close();
    $conn->close();
}
?>
