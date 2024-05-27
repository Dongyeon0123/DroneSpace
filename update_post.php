<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['postnum'], $_POST['postcontent'])) {
    $postnum = $_POST['postnum'];
    $postcontent = $_POST['postcontent'];

    if ($stmt = $conn->prepare("UPDATE post SET postcontent = ? WHERE postnum = ? AND memberid = ?")) {
        $stmt->bind_param("sis", $postcontent, $postnum, $_SESSION['memberid']);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('게시글이 수정되었습니다.'); window.location.href='everything.php';</script>";
        } else {
            echo "<script>alert('게시글 수정에 실패했습니다.'); window.history.back();</script>";
        }
        $stmt->close();
    } else {
        echo "SQL 문을 준비하는데 오류가 발생했습니다: " . $conn->error;
    }
}
$conn->close();
?>
