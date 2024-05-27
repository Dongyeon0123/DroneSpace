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
        .post {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .post p {
            margin: 5px 0;
        }
        .comments {
            margin-top: 20px;
        }
        .comment {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f9f9f9;
            margin-bottom: 10px;
        }
        .comment p {
            margin: 5px 0;
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
    <div class="container">
        <div class="post">
            <p style="font-size: 24px; font-weight:bold;">Q. <?= htmlspecialchars($posttitle); ?></p><br>
            <p><?= nl2br(htmlspecialchars($postcontent)); ?></p><br><br>
            <p>작성자: <?= htmlspecialchars($name); ?></p>
            <p>게시일: <?= htmlspecialchars($postdate); ?></p>
            <p><i id="like-icon-<?= $postnum; ?>" class="far fa-heart like-icon <?= ($user_liked > 0 ? 'liked' : '') ?>" onclick="toggleLike(<?= $postnum; ?>, '<?= $_SESSION['memberid']; ?>');"></i> : <span id="like-count-<?= $postnum; ?>"><?= $like_count; ?></span></p>
            <?php if ($_SESSION['memberid'] == $memberid): ?>
                <button onclick="editPost(<?= $postnum; ?>)">수정</button>
                <button class="delete-button" onclick="deletePost(<?= $postnum; ?>)">삭제</button>
            <?php endif; ?>
        </div>

        <h2>댓글</h2>
        <div class="comments">
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <p><?= nl2br(htmlspecialchars($comment['commentcontent'])); ?></p><br>
                    <p>작성자: <?= htmlspecialchars($comment['name']); ?></p>
                    <p>작성일: <?= date("Y-m-d H:i", strtotime($comment['commentdate'])); ?></p> <!-- 작성 날짜 표시 -->
                    <p><i id="comment-like-icon-<?= $comment['commentnum']; ?>" class="far fa-heart like-icon <?= ($comment['user_liked'] > 0 ? 'liked' : '') ?>" onclick="toggleCommentLike(<?= $comment['commentnum']; ?>, '<?= $_SESSION['memberid']; ?>');"></i> : <span id="comment-like-count-<?= $comment['commentnum']; ?>"><?= $comment['like_count']; ?></span></p>
                    <?php if ($_SESSION['memberid'] == $comment['memberid']): ?>
                        <button class="delete-button" onclick="deleteComment(<?= $comment['commentnum']; ?>)">삭제</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <form id="comment-form" action="add_comment.php" method="post">
            <input type="hidden" name="postnum" value="<?= $postnum ?>">
            <textarea id="comment-content" name="commentcontent" required></textarea>
            <button type="submit">댓글 작성</button> <!-- type="submit" 추가 -->
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
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
                    data: {postnum: postnum},
                    success: function(data) {
                        var response = JSON.parse(data);
                        if (response.success) {
                            alert('게시글이 성공적으로 삭제되었습니다.');
                            window.location.href = 'everything.php'; // 성공 시 페이지 이동
                        } else {
                            alert('게시글 삭제에 실패했습니다: ' + response.error);
                        }
                    },
                    error: function() {
                        alert('게시글 삭제 요청에 실패했습니다.');
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
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.success) {
                        alert('댓글이 성공적으로 작성되었습니다.');
                        location.reload();  // 페이지 새로 고침
                    } else {
                        alert('댓글 작성에 실패했습니다.');
                    }
                },
                error: function() {
                    alert('댓글 작성에 실패했습니다.');
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
                            alert(response.error);
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
