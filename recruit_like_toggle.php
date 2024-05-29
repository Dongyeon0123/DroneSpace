<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo json_encode(['success' => false, 'error' => '로그인이 필요합니다.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recruitnum = $_POST['recruitnum'];
    $memberid = $_POST['memberid'];

    // 좋아요 상태 확인
    $stmt = $conn->prepare("SELECT COUNT(*) FROM recruitment_likes WHERE recruitnum = ? AND memberid = ?");
    $stmt->bind_param("is", $recruitnum, $memberid);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // 좋아요 취소
        $stmt = $conn->prepare("DELETE FROM recruitment_likes WHERE recruitnum = ? AND memberid = ?");
        $stmt->bind_param("is", $recruitnum, $memberid);
        $stmt->execute();
        $stmt->close();
        $liked = false;
    } else {
        // 좋아요 추가
        $stmt = $conn->prepare("INSERT INTO recruitment_likes (recruitnum, memberid) VALUES (?, ?)");
        $stmt->bind_param("is", $recruitnum, $memberid);
        $stmt->execute();
        $stmt->close();
        $liked = true;
    }

    // 총 좋아요 수 확인
    $stmt = $conn->prepare("SELECT COUNT(*) FROM recruitment_likes WHERE recruitnum = ?");
    $stmt->bind_param("i", $recruitnum);
    $stmt->execute();
    $stmt->bind_result($like_count);
    $stmt->fetch();
    $stmt->close();

    echo json_encode(['liked' => $liked, 'like_count' => $like_count]);
}

$conn->close();
?>
