<?php
session_start();

// 로그인 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "skso1951";
    $dbname = "dbwork";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $title = $_POST['title'];
    $content = $_POST['content'];
    $memberid = $_SESSION['memberid'];  // 세션에서 사용자 ID 가져오기

    $sql = "INSERT INTO post (memberid, postcontent, postdate) VALUES (?, ?, CURDATE())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $memberid, $content);

    if ($stmt->execute()) {
        echo "<script>alert('게시글이 성공적으로 등록되었습니다.'); window.location.href='everything.php';</script>";
    } else {
        echo "<script>alert('게시글 등록에 실패했습니다.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
