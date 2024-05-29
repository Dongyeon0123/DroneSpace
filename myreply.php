<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

$memberid = $_SESSION['memberid'];

// 사용자가 작성한 댓글 조회
$comments = [];
$stmt = $conn->prepare("SELECT c.commentnum, c.commentcontent, c.commentdate, p.postnum, p.posttitle 
                        FROM commenttbl c 
                        JOIN post p ON c.postnum = p.postnum 
                        WHERE c.memberid = ? 
                        ORDER BY c.commentnum DESC");
$stmt->bind_param("s", $memberid);
if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
    $stmt->close();
} else {
    echo "SQL 문을 준비하는데 오류가 발생했습니다: " . $conn->error;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>내가 작성한 댓글</title>
    <link rel="stylesheet" href="main.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #4A54E1;
        }
        .comment {
            padding: 15px;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            cursor: pointer;
        }
        .comment h2 {
            font-size: 20px;
            margin: 0 0 10px 0;
        }
        .comment p {
            margin: 5px 0;
        }
        .comment:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <?php
        require_once "header.php";
    ?>
    <div class="container">
        <h1>내가 작성한 댓글</h1>
        <div>
            <?php foreach ($comments as $comment): ?>
                <div class="comment" onclick="viewPost(<?= $comment['postnum']; ?>)">
                    <h2><?= htmlspecialchars($comment['posttitle']); ?></h2>
                    <p><?= nl2br(htmlspecialchars($comment['commentcontent'])); ?></p>
                    <p>작성일: <?= htmlspecialchars($comment['commentdate']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        function viewPost(postnum) {
            location.href = 'post_detail.php?postnum=' + postnum;
        }
        function toggleMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.toggle('show');
        }
        
        // 하위 메뉴 링크 클릭 시 메뉴 숨기기
        document.querySelectorAll('.menu-overlay-content ul li ul li a').forEach(function(link) {
            link.addEventListener('click', function() {
                var menuOverlay = document.getElementById('menuOverlay');
                menuOverlay.classList.remove('show');
            });
        });

        function closeMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.remove('show');  // 'show' 클래스를 제거하여 팝업 숨김
        }
    </script>
</body>
</html>
