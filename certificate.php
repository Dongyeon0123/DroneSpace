<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

// 구인 게시글 목록 조회
$recruitments = [];
$stmt = $conn->prepare("SELECT r.recruitnum, r.memberid, r.title, r.description, r.postdate, m.name, (SELECT COUNT(*) FROM recruitment_likes WHERE recruitnum = r.recruitnum) AS like_count FROM recruitment r JOIN membertbl m ON r.memberid = m.memberid ORDER BY r.recruitnum DESC");
if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $recruitments[] = $row;
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
    <title>구인 & 구직 게시판</title>
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
        .recruitment {
            padding: 15px;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            cursor: pointer;
        }
        .recruitment h2 {
            font-size: 24px;
            margin: 0 0 10px 0;
        }
        .recruitment p {
            margin: 5px 0;
        }
        .recruitment:hover {
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
        <h1>구인 & 구직 게시판</h1>
        <button onclick="location.href='recruit_form.php'">구인글 작성</button>
        <div>
            <?php foreach ($recruitments as $recruitment): ?>
                <div class="recruitment" onclick="viewRecruitment(<?= $recruitment['recruitnum']; ?>)">
                    <h2><?= htmlspecialchars($recruitment['title']); ?></h2>
                    <p><?= nl2br(htmlspecialchars($recruitment['description'])); ?></p>
                    <p>작성자: <?= htmlspecialchars($recruitment['name']); ?></p>
                    <p>게시일: <?= htmlspecialchars($recruitment['postdate']); ?></p>
                    <p><i id="like-icon-<?= $recruitment['recruitnum']; ?>" class="far fa-heart like-icon <?= $recruitment['like_count'] ? 'liked' : '' ?>" onclick="event.stopPropagation(); toggleLike(<?= $recruitment['recruitnum']; ?>, '<?= $_SESSION['memberid']; ?>');"></i> : <span id="like-count-<?= $recruitment['recruitnum']; ?>"><?= $recruitment['like_count']; ?></span></p>
                    <?php if ($_SESSION['memberid'] == $recruitment['memberid']): ?>
                        <button onclick="event.stopPropagation(); editRecruitment(<?= $recruitment['recruitnum']; ?>)">수정</button>
                        <button class="delete-button" onclick="event.stopPropagation(); deleteRecruitment(<?= $recruitment['recruitnum']; ?>)">삭제</button>
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
        function viewRecruitment(recruitnum) {
            location.href = 'recruit_detail.php?recruitnum=' + recruitnum;
        }

        function editRecruitment(recruitnum) {
            if (confirm('구인글을 수정하시겠습니까?')) {
                location.href = 'edit_recruit_form.php?recruitnum=' + recruitnum;
            }
        }

        function deleteRecruitment(recruitnum) {
            if (confirm('정말로 삭제하시겠습니까?')) {
                $.post('delete_recruit.php', { recruitnum: recruitnum }, function(data) {
                    alert('구인글이 삭제되었습니다.');
                    window.location.href = 'recruitment.php';
                });
            }
        }

        function toggleLike(recruitnum, memberid) {
            $.post('recruit_like_toggle.php', { recruitnum: recruitnum, memberid: memberid }, function(data) {
                var response = JSON.parse(data);
                if (response.liked) {
                    $('#like-icon-' + recruitnum).addClass('liked').removeClass('far').addClass('fas');
                } else {
                    $('#like-icon-' + recruitnum).removeClass('liked').addClass('far').removeClass('fas');
                }
                $('#like-count-' + recruitnum).text(response.like_count);
            });
        }
    </script>
</body>
</html>
