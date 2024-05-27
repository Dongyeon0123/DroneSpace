<?php
session_start();
include 'db.php'; // 데이터베이스 연결 파일 포함

$postnum = $_POST['postnum'];
$memberid = $_POST['memberid'];

// 좋아요 상태 확인
$query = $conn->prepare("SELECT * FROM likes WHERE postnum = ? AND memberid = ?");
$query->bind_param("is", $postnum, $memberid);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    // 이미 좋아요를 눌렀다면 삭제
    $query = $conn->prepare("DELETE FROM likes WHERE postnum = ? AND memberid = ?");
    $liked = false;
} else {
    // 좋아요가 없다면 추가
    $query = $conn->prepare("INSERT INTO likes (postnum, memberid) VALUES (?, ?)");
    $liked = true;
}
$query->bind_param("is", $postnum, $memberid);
$query->execute();

// 좋아요 수 카운트
$query = $conn->prepare("SELECT COUNT(*) as like_count FROM likes WHERE postnum = ?");
$query->bind_param("i", $postnum);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();

echo json_encode(['liked' => $liked, 'like_count' => $row['like_count']]);
?>
