<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo json_encode(['error' => '로그인이 필요합니다.']);
    exit;
}

$keyword = $_GET['keyword'] ?? '';

$posts = [];
if ($stmt = $conn->prepare("SELECT p.postnum, p.memberid, p.posttitle, p.postcontent, p.postdate, m.name, 
                            (SELECT COUNT(*) FROM likes WHERE postnum = p.postnum) AS like_count 
                            FROM post p 
                            JOIN membertbl m ON p.memberid = m.memberid 
                            WHERE p.posttitle LIKE ? OR p.postcontent LIKE ? 
                            ORDER BY p.postnum DESC")) {
    $searchKeyword = "%{$keyword}%";
    $stmt->bind_param("ss", $searchKeyword, $searchKeyword);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $row['url'] = 'post_detail.php?postnum=' . $row['postnum']; // 게시물 URL 생성
        $posts[] = $row;
    }
    $stmt->close();
} else {
    echo json_encode(['error' => 'SQL 문을 준비하는데 오류가 발생했습니다: ' . $conn->error]);
    exit;
}

$conn->close();
echo json_encode(['posts' => $posts]);
?>
