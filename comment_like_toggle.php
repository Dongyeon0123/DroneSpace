<?php
session_start();
require_once 'db.php'; // 데이터베이스 연결 설정 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo json_encode(['error' => '로그인이 필요합니다.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentnum = $_POST['commentnum'];
    $memberid = $_POST['memberid'];

    $stmt = $conn->prepare("SELECT * FROM comment_likes WHERE commentnum = ? AND memberid = ?");
    $stmt->bind_param("is", $commentnum, $memberid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("DELETE FROM comment_likes WHERE commentnum = ? AND memberid = ?");
        $stmt->bind_param("is", $commentnum, $memberid);
        $stmt->execute();
        $liked = false;
    } else {
        $stmt = $conn->prepare("INSERT INTO comment_likes (commentnum, memberid) VALUES (?, ?)");
        $stmt->bind_param("is", $commentnum, $memberid);
        $stmt->execute();
        $liked = true;
    }

    $stmt = $conn->prepare("SELECT COUNT(*) as like_count FROM comment_likes WHERE commentnum = ?");
    $stmt->bind_param("i", $commentnum);
    $stmt->execute();
    $stmt->bind_result($like_count);
    $stmt->fetch();

    echo json_encode(['liked' => $liked, 'like_count' => $like_count]);

    $stmt->close();
}

$conn->close();
?>
