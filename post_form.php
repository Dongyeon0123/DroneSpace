<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

require_once 'db.php'; // 데이터베이스 연결 설정 포함

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title']; // 게시글 제목
    $content = $_POST['content']; // 게시글 내용
    $memberid = $_SESSION['memberid']; // 세션에서 사용자 ID 가져오기

    $sql = "INSERT INTO post (memberid, posttitle, postcontent, postdate) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $memberid, $title, $content);
    if ($stmt->execute()) {
        echo "<script>alert('게시글이 성공적으로 작성되었습니다.'); window.location.href='everything.php';</script>";
    } else {
        echo "<script>alert('게시글 작성에 실패했습니다.'); window.history.back();</script>";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 작성</title>
</head>
<body>
    <h1>게시글 작성</h1>
    <form method="post" action="post_form.php">
        <label for="title">제목:</label>
        <input type="text" id="title" name="title" required>
        <label for="content">내용:</label>
        <textarea id="content" name="content" required></textarea>
        <button type="submit">게시</button>
    </form>
</body>
</html>
