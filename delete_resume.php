<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(['success' => false, 'message' => '로그인이 필요합니다.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resume_id = $_POST['id'];
    $memberid = $_SESSION['memberid'];

    $stmt = $conn->prepare("DELETE FROM resumes WHERE resume_id = ? AND memberid = ?");
    $stmt->bind_param("is", $resume_id, $memberid);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => '이력서 삭제에 실패했습니다.']);
    }

    $stmt->close();
}

$conn->close();
?>
