<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if (!isset($_GET['postnum'])) {
    echo "<script>alert('잘못된 접근입니다.'); window.location.href='everything.php';</script>";
    exit;
}

$postnum = $_GET['postnum'];

// 게시글 조회
$stmt = $conn->prepare("SELECT p.postnum, p.memberid, p.posttitle, p.postcontent, p.postdate, m.name, 
(SELECT COUNT(*) FROM likes WHERE postnum = p.postnum) as like_count, 
(SELECT COUNT(*) FROM likes WHERE postnum = p.postnum AND memberid = ?) as user_liked 
FROM post p 
JOIN membertbl m ON p.memberid = m.memberid 
WHERE p.postnum = ?");
$stmt->bind_param("si", $_SESSION['memberid'], $postnum);
$stmt->execute();
$stmt->bind_result($postnum, $memberid, $posttitle, $postcontent, $postdate, $name, $like_count, $user_liked);
$stmt->fetch();
$stmt->close();

// 댓글 조회
$comments = [];
$stmt = $conn->prepare("SELECT c.commentnum, c.commentcontent, c.memberid, m.name, c.commentdate,
(SELECT COUNT(*) FROM comment_likes WHERE commentnum = c.commentnum) as like_count, 
(SELECT COUNT(*) FROM comment_likes WHERE commentnum = c.commentnum AND memberid = ?) as user_liked 
FROM commenttbl c 
JOIN membertbl m ON c.memberid = m.memberid 
WHERE c.postnum = ? ORDER BY c.commentnum ASC");
$stmt->bind_param("si", $_SESSION['memberid'], $postnum);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 상세보기</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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
        h1, h2 {
            text-align: center;
            color: #4A54E1;
        }
        .comment-form {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }
        .comment-form textarea {
            resize: vertical;
            padding: 10px;
            height: 100px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .post, .comment {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .post p, .comment p {
            margin: 5px 0;
        }
        .comment-form button {
            padding: 10px 20px;
            background-color: #5C67F2;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .comment-form button:hover {
            background-color: #4A54E1;
        }

        .comment-form textarea:focus,
        .comment-form button:focus {
            outline: none;
            border-color: #4A54E1;
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
        <div class="post">
            <p style="font-size: 24px;"><span style="color: blue;">Q. </span> <?= htmlspecialchars($posttitle); ?></p><br>
            <p><?= nl2br(htmlspecialchars($postcontent)); ?></p><br><br>
            <p>작성자: <?= htmlspecialchars($memberid); ?></p>
            <p>게시일: <?= htmlspecialchars($postdate); ?></p><br>
            <p><i id="like-icon-<?= $postnum; ?>" class="fa-heart like-icon <?= ($user_liked > 0 ? 'fas liked' : 'far') ?>" onclick="toggleLike(<?= $postnum; ?>, '<?= $_SESSION['memberid']; ?>');"></i> : <span id="like-count-<?= $postnum; ?>"><?= $like_count; ?></span></p>
            <?php if ($_SESSION['memberid'] == $memberid): ?><br><br>
                <button onclick="editPost(<?= $postnum; ?>)">수정</button>
            <?php endif; ?>
        </div>

        <h2>댓글</h2>
        <div class="comments">
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <p style="font-weight: bold;"><?= htmlspecialchars($comment['memberid']); ?></p><br>
                    <p><?= nl2br(htmlspecialchars($comment['commentcontent'])); ?></p><br>
                    <p>작성일: <?= date("Y-m-d H:i", strtotime($comment['commentdate'])); ?></p>
                    <p><i id="comment-like-icon-<?= $comment['commentnum']; ?>" class="fa-heart like-icon <?= ($comment['user_liked'] > 0 ? 'fas liked' : 'far') ?>" onclick="toggleCommentLike(<?= $comment['commentnum']; ?>, '<?= $_SESSION['memberid']; ?>');"></i> : <span id="comment-like-count-<?= $comment['commentnum']; ?>"><?= $comment['like_count']; ?></span></p>
                    <?php if ($_SESSION['memberid'] == $comment['memberid']): ?><br>
                        <button class="delete-button" onclick="deleteComment(<?= $comment['commentnum']; ?>)">댓글 삭제</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <form method="POST" action="add_comment.php" class="comment-form">
            <input type="hidden" name="postnum" value="<?= $postnum; ?>">
            <textarea name="commentcontent" required placeholder="댓글을 입력하세요."></textarea>
            <button type="submit">댓글 작성</button>
        </form>
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
        function editPost(postnum) {
            if (confirm('게시글을 수정하시겠습니까?')) {
                location.href = 'edit_post_form.php?postnum=' + postnum;
            }
        }

        function deletePost(postnum) {
            if (confirm('정말로 삭제하시겠습니까?')) {
                $.ajax({
                    url: 'delete_post.php',
                    type: 'POST',
                    data: { postnum: postnum },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert('게시글이 삭제되었습니다.');
                            window.location.href = 'everything.php';  // 메인 페이지로 이동
                        } else {
                            alert('게시글 삭제에 실패했습니다: ' + response.error);
                        }
                    },
                    error: function() {
                        alert('게시글 삭제 요청을 처리할 수 없습니다.');
                    }
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

        function toggleCommentLike(commentnum, memberid) {
            $.post('comment_like_toggle.php', { commentnum: commentnum, memberid: memberid }, function(data) {
                var response = JSON.parse(data);
                if (response.liked) {
                    $('#comment-like-icon-' + commentnum).addClass('liked').removeClass('far').addClass('fas');
                } else {
                    $('#comment-like-icon-' + commentnum).removeClass('liked').addClass('far').removeClass('fas');
                }
                $('#comment-like-count-' + commentnum).text(response.like_count);
            });
        }

        $('#comment-form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: 'add_comment.php',
                type: 'POST',
                data: formData,
                dataType: 'json', // 명시적으로 JSON 응답을 예상한다고 설정
                success: function(response) {
                    if (response.success) {
                        alert('댓글이 성공적으로 작성되었습니다.');
                        location.reload();  // 페이지 새로 고침
                    } else {
                        alert('댓글 작성에 실패했습니다: ' + response.error);
                    }
                },
                error: function(xhr) {
                    alert('댓글 작성 요청에 실패했습니다. 서버 오류가 발생했을 수 있습니다.');
                }
            });
        });
        function deleteComment(commentnum) {
            if (confirm('정말로 댓글을 삭제하시겠습니까?')) {
                $.ajax({
                    url: 'delete_comment.php',
                    type: 'POST',
                    data: { commentnum: commentnum },
                    success: function(data) {
                        var response = JSON.parse(data);
                        if (response.success) {
                            alert('댓글이 삭제되었습니다.');
                            location.reload();  // 페이지 새로 고침
                        } else {
                            alert('댓글 삭제에 실패했습니다: ' + response.error);
                        }
                    },
                    error: function() {
                        alert('댓글 삭제에 실패했습니다.');
                    }
                });
            }
        }
    </script>
</body>
</html>
