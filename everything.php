<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

// 게시글 목록 조회
$posts = [];
$stmt = $conn->prepare("SELECT p.postnum, p.memberid, p.posttitle, p.postcontent, p.postdate, m.name, 
                        (SELECT COUNT(*) FROM likes WHERE postnum = p.postnum) AS like_count,
                        (SELECT COUNT(*) FROM likes WHERE postnum = p.postnum AND memberid = ?) AS user_liked 
                        FROM post p 
                        JOIN membertbl m ON p.memberid = m.memberid 
                        ORDER BY p.postnum DESC");
$stmt->bind_param("s", $_SESSION['memberid']);
if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>커뮤니티 게시판</title>
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
        <h1>커뮤니티 게시판</h1>
        <button onclick="location.href='post_form.php'">게시글 작성</button>
        <div>
            <?php foreach ($posts as $post): ?>
                <div class="post" onclick="viewPost(<?= $post['postnum']; ?>)">
                    <p style="font-size: 24px;"><span style="color: blue;">Q. </span> <?= htmlspecialchars($post['posttitle']); ?></p><br>
                    <p><?= nl2br(htmlspecialchars($post['postcontent'])); ?></p><br>
                    <p>작성자: <?= htmlspecialchars($post['name']); ?></p>
                    <p>게시일: <?= htmlspecialchars($post['postdate']); ?></p><br>
                    <p><i id="like-icon-<?= $post['postnum']; ?>" class="fa-heart like-icon <?= ($post['user_liked'] > 0 ? 'fas liked' : 'far') ?>" onclick="event.stopPropagation(); toggleLike(<?= $post['postnum']; ?>, '<?= $_SESSION['memberid']; ?>');"></i> : <span id="like-count-<?= $post['postnum']; ?>"><?= $post['like_count']; ?></span></p>
                    <?php if ($_SESSION['memberid'] == $post['memberid']): ?><br><br>
                        <button onclick="event.stopPropagation(); editPost(<?= $post['postnum']; ?>)">수정</button>
                        <button class="delete-button" onclick="event.stopPropagation(); deletePost(<?= $post['postnum']; ?>)">삭제</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
            location.href = 'post_detail.php?postnum=' + postnum;
        }

        function editPost(postnum) {
            if (confirm('게시글을 수정하시겠습니까?')) {
                location.href = 'edit_post_form.php?postnum=' + postnum;
            }
        }

        function deletePost(postnum) {
            if (confirm('정말로 삭제하시겠습니까?')) {
                $.post('delete_post.php', { postnum: postnum }, function(data) {
                    alert('게시글이 삭제되었습니다.');
                    window.location.href = 'everything.php';
                });
            }
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
