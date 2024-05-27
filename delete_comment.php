<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo json_encode(['error' => '로그인이 필요합니다.']);
    exit;
}

if (isset($_POST['commentnum'])) {
    $commentnum = $_POST['commentnum'];

    // 댓글 삭제 쿼리 준비
    $stmt = $conn->prepare("DELETE FROM commenttbl WHERE commentnum = ?");
    $stmt->bind_param("i", $commentnum);

    // 쿼리 실행
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);  // 성공 시 JSON 응답
    } else {
        // 쿼리 실행 실패 시, SQL 오류 출력
        echo json_encode(['error' => '댓글 삭제에 실패했습니다.', 'sql_error' => $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>
