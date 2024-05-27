<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postnum = $_POST['postnum'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE post SET posttitle = ?, postcontent = ? WHERE postnum = ? AND memberid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $title, $content, $postnum, $_SESSION['memberid']);

    if ($stmt->execute()) {
        echo "<script>alert('게시글이 수정되었습니다.'); window.location.href='everything.php';</script>";
    } else {
        echo "<script>alert('게시글 수정에 실패했습니다.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['postnum'])) {
    $postnum = $_GET['postnum'];

    $sql = "SELECT posttitle, postcontent FROM post WHERE postnum = ? AND memberid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $postnum, $_SESSION['memberid']);
    $stmt->execute();
    $stmt->bind_result($title, $content);
    $stmt->fetch();

    if (!$title || !$content) {
        echo "<script>alert('게시글을 찾을 수 없습니다.'); window.location.href='everything.php';</script>";
        exit;
    }

    $stmt->close();
} else {
    echo "<script>alert('잘못된 요청입니다.'); window.location.href='everything.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 수정</title>
</head>
<body>
    <h1>게시글 수정</h1>
    <form method="post" action="edit_post_form.php">
        <input type="hidden" name="postnum" value="<?= htmlspecialchars($postnum); ?>">
        <label for="title">제목:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($title); ?>" required>
        <label for="content">내용:</label>
        <textarea id="content" name="content" required><?= htmlspecialchars($content); ?></textarea>
        <button type="submit">수정</button>
    </form>
</body>
</html>
