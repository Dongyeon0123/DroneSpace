<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

// 10개 이상의 좋아요를 받은 게시글 조회
$sql = "SELECT p.postnum, p.posttitle, p.postcontent, p.postdate, m.name, COUNT(l.postnum) AS like_count
        FROM post p
        JOIN membertbl m ON p.memberid = m.memberid
        LEFT JOIN likes l ON p.postnum = l.postnum
        GROUP BY p.postnum, p.posttitle, p.postcontent, p.postdate, m.name
        HAVING COUNT(l.postnum) >= 10
        ORDER BY like_count DESC, p.postdate DESC";

$stmt = $conn->prepare($sql);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $posts = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "<script>alert('데이터를 불러오는데 실패했습니다.'); window.history.back();</script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>HOT 게시글</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
        .post {
            padding: 15px;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            cursor: pointer;
        }
        .post h2 {
            font-size: 24px;
            margin: 0 0 10px 0;
        }
        .post p {
            margin: 5px 0;
        }
        .post:hover {
            background-color: #f9f9f9;
        }
        button {
            padding: 10px 15px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            background-color: #5C67F2;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #4a54e1;
        }
        .delete-button {
            background-color: #FF4B4B;
        }
        .delete-button:hover {
            background-color: #D43F3F;
        }
        .like-icon {
            color: grey;
            cursor: pointer;
        }
        .like-icon.liked {
            color: red;
        }
    </style>
</head>
<body>
    <?php
        require_once "header.php";
    ?>
    <div class="container">
        <h1>HOT 게시글</h1>
        <div>
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <div  class="post" onclick="viewPost(<?= $post['postnum']; ?>)">
                        <p style="font-size: 24px;"><span style="color: blue;">Q. </span> <?= htmlspecialchars($post['posttitle']); ?></p><br>
                        <p><?= nl2br(htmlspecialchars($post['postcontent'])); ?></p><br>
                        <p>작성자: <?= htmlspecialchars($post['name']); ?></p>
                        <p>게시일: <?= htmlspecialchars($post['postdate']); ?></p><br>
                        <p><i id="like-icon-<?= $post['postnum']; ?>" class="fa-heart like-icon <?= ($post['like_count'] > 0 ? 'fas liked' : 'far') ?>" onclick="event.stopPropagation(); toggleLike(<?= $post['postnum']; ?>, '<?= $_SESSION['memberid']; ?>');"></i> : <span id="like-count-<?= $post['postnum']; ?>"><?= $post['like_count']; ?></span></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>10개 이상의 좋아요를 받은 게시글이 없습니다.</p>
            <?php endif; ?>
        </div>
    </div>
    <footer class="footer">
        <p>Copyright &copy; 2024 Drone Space</p>
    </footer>
    <script>
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
        function viewPost(postnum) {
            window.location.href = 'post_detail.php?postnum=' + postnum;
        }
        function toggleLike(postnum, memberid) {
            $.post('like_toggle.php', { postnum: postnum, memberid: memberid }, function(data) {
                var response = JSON.parse(data);
                if (response.liked) {
                    $('#like-icon-' + postnum).addClass('liked').removeClass('far').addClass('fas');
                } else {
                    $('#like-icon-' + postnum).removeClass('liked').addClass('far').removeClass('fas');
                }
                $('#like-count-' + postnum).text(response.like_count);
            });
        }
    </script>
</body>
</html>
