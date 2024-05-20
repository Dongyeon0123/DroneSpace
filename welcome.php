<?php
session_start();

// 사용자가 로그인했는지 확인
if (!isset($_SESSION['memberid'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>환영합니다</title>
</head>
<body>
    <h2>환영합니다!</h2>
    <p>로그인 성공!</p>
    <a href="logout.php">로그아웃</a>
</body>
</html>
