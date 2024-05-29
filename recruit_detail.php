<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if (!isset($_GET['recruitnum'])) {
    echo "<script>alert('잘못된 접근입니다.'); window.location.href='recruitment.php';</script>";
    exit;
}

$recruitnum = $_GET['recruitnum'];

// 구인글 조회
$stmt = $conn->prepare("SELECT r.*, m.name, 
(SELECT COUNT(*) FROM recruitment_likes WHERE recruitnum = r.recruitnum) as like_count, 
(SELECT COUNT(*) FROM recruitment_likes WHERE recruitnum = r.recruitnum AND memberid = ?) as user_liked 
FROM recruitment r 
JOIN membertbl m ON r.memberid = m.memberid 
WHERE r.recruitnum = ?");
$stmt->bind_param("si", $_SESSION['memberid'], $recruitnum);
$stmt->execute();
$result = $stmt->get_result();
$recruit = $result->fetch_assoc();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>구인글 상세보기</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="main.css">
    <style>
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .recruitment {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .recruitment h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .recruitment p {
            margin: 10px 0;
        }
        .recruitment .info {
            margin-top: 20px;
        }
        .recruitment .info p {
            margin: 5px 0;
        }
        .like-icon {
            color: grey;
            cursor: pointer;
        }
        .like-icon.liked {
            color: red;
        }
        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
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

        .apply-button {
            margin-top: 20px;
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            background-color: #5C67F2;
            color: white;
            cursor: pointer;
        }
        .apply-button:hover {
            background-color: #4a54e1;
        }
    </style>
</head>
<body>
    <?php require_once 'header.php'; ?>
    <div class="container">
        <div class="recruitment">
            <h2><?= htmlspecialchars($recruit['title']); ?></h2>
            <p><?= nl2br(htmlspecialchars($recruit['description'])); ?></p>
            <p>지역: <?= htmlspecialchars($recruit['region']); ?></p>
            <p>자격증: <?= htmlspecialchars($recruit['qualifications']); ?></p>
            <p>기업 명: <?= htmlspecialchars($recruit['company_name']); ?></p>
            <p>근무 시간: <?= htmlspecialchars($recruit['working_hours_start']); ?> - <?= htmlspecialchars($recruit['working_hours_end']); ?></p>
            <p>근무 기간: <?= htmlspecialchars($recruit['working_period']); ?></p>
            <p>작성자: <?= htmlspecialchars($recruit['name']); ?></p>
            <p>게시일: <?= htmlspecialchars($recruit['postdate']); ?></p>
            <p>
                <i id="like-icon-<?= $recruit['recruitnum']; ?>" class="fa-heart like-icon <?= ($recruit['user_liked'] > 0 ? 'fas liked' : 'far') ?>" onclick="toggleLike(<?= $recruit['recruitnum']; ?>, '<?= $_SESSION['memberid']; ?>');"></i> 
                <span id="like-count-<?= $recruit['recruitnum']; ?>"><?= $recruit['like_count']; ?></span>
            </p>
            <?php if ($_SESSION['memberid'] == $recruit['memberid']): ?>
                <button onclick="location.href='edit_recruit_form.php?recruitnum=<?= $recruitnum; ?>'">수정</button>
                <button class="delete-button" onclick="deleteRecruitment(<?= $recruitnum; ?>)">삭제</button>
            <?php endif; ?>

            <h3>연락처 정보</h3>
            <p>이름: <?= htmlspecialchars($recruit['contact_name']); ?></p>
            <p>연락처: <?= htmlspecialchars($recruit['contact_phone']); ?></p>
            <p>이메일: <?= htmlspecialchars($recruit['contact_email']); ?></p>
            <button onclick="openApplyForm()">신청하기</button>
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

        function deleteRecruitment(recruitnum) {
            if (confirm('정말로 삭제하시겠습니까?')) {
                $.post('delete_recruit.php', { recruitnum: recruitnum }, function(data) {
                    alert('구인글이 삭제되었습니다.');
                    window.location.href = 'recruitment.php';
                });
            }
        }
        function openApplyForm() {
            window.open('apply.php?recruitnum=<?= $recruitnum; ?>', 'applyForm', 'width=600,height=600');
        }
    </script>
</body>
</html>
