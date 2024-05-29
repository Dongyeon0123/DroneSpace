<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

$memberid = $_SESSION['memberid'];

// 사용자가 작성한 구인&구직 글 조회
$recruitments = [];
$stmt = $conn->prepare("SELECT recruitnum, title, description, postdate FROM recruitment WHERE memberid = ? ORDER BY postdate DESC");
$stmt->bind_param("s", $memberid);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $recruitments[] = $row;
}
$stmt->close();

// 각 구인&구직 글에 대한 신청 내역 조회
$applications = [];
foreach ($recruitments as $recruitment) {
    $stmt = $conn->prepare("SELECT a.*, r.name as resume_name, m.name as applicant_name 
                            FROM applications a 
                            JOIN resumes r ON a.resume_id = r.resume_id 
                            JOIN membertbl m ON a.memberid = m.memberid 
                            WHERE a.recruitnum = ?");
    $stmt->bind_param("i", $recruitment['recruitnum']);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $applications[$recruitment['recruitnum']][] = $row;
    }
    $stmt->close();
}

// 사용자가 신청한 구직 현황 조회
$user_applications = [];
$stmt = $conn->prepare("SELECT a.*, r.title, r.description, r.postdate, m.name as recruiter_name 
                        FROM applications a 
                        JOIN recruitment r ON a.recruitnum = r.recruitnum 
                        JOIN membertbl m ON r.memberid = m.memberid 
                        WHERE a.memberid = ? ORDER BY a.apply_date DESC");
$stmt->bind_param("s", $memberid);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $user_applications[] = $row;
}
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>내가 작성한 구인&구직 현황</title>
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
        h1, h2 {
            text-align: center;
            color: #4A54E1;
        }
        .section {
            margin-top: 30px;
        }
        .recruitment, .application {
            padding: 15px;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .recruitment h2, .application h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .recruitment p, .application p {
            margin: 5px 0;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 5px;
            width: 60%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .popup h3 {
            margin-top: 0;
        }
        .close-btn {
            display: inline-block;
            padding: 10px;
            background-color: #5C67F2;
            color: white;
            text-align: center;
            cursor: pointer;
            border-radius: 5px;
        }
        .resume-link {
            color: #007bff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php require_once 'header.php'; ?>
    <div class="container">
        <h1>내가 작성한 구인&구직 현황</h1>

        <div class="section">
            <h2>내가 작성한 구인 글</h2>
            <?php if (empty($recruitments)): ?>
                <p>작성한 구인 글이 없습니다.</p>
            <?php else: ?>
                <?php foreach ($recruitments as $recruitment): ?>
                    <div class="recruitment">
                        <h3><?= htmlspecialchars($recruitment['title']); ?></h3>
                        <p><?= nl2br(htmlspecialchars($recruitment['description'])); ?></p>
                        <p>게시일: <?= htmlspecialchars($recruitment['postdate']); ?></p>
                        <h3>신청자 목록</h3>
                        <?php if (empty($applications[$recruitment['recruitnum']])): ?>
                            <p>신청자가 없습니다.</p>
                        <?php else: ?>
                            <?php foreach ($applications[$recruitment['recruitnum']] as $application): ?>
                                <div class="application">
                                    <p>신청자: <?= htmlspecialchars($application['applicant_name']); ?></p>
                                    <p class="resume-link" data-resume-id="<?= $application['resume_id']; ?>">이력서: <?= htmlspecialchars($application['resume_name']); ?></p>
                                    <p>신청 메시지: <?= nl2br(htmlspecialchars($application['message'])); ?></p>
                                    <p>신청일: <?= htmlspecialchars($application['apply_date']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="section">
            <h2>내가 신청한 구직 현황</h2>
            <?php if (empty($user_applications)): ?>
                <p>신청한 구직 현황이 없습니다.</p>
            <?php else: ?>
                <?php foreach ($user_applications as $application): ?>
                    <div class="application">
                        <h2><?= htmlspecialchars($application['title']); ?></h2>
                        <p><?= nl2br(htmlspecialchars($application['description'])); ?></p>
                        <p>게시일: <?= htmlspecialchars($application['postdate']); ?></p>
                        <p>작성자: <?= htmlspecialchars($application['recruiter_name']); ?></p>
                        <p>신청 메시지: <?= nl2br(htmlspecialchars($application['message'])); ?></p>
                        <p>신청일: <?= htmlspecialchars($application['apply_date']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div id="resume-popup" class="popup">
        <h3>이력서 상세 내용</h3>
        <div id="resume-content"></div>
        <div class="close-btn" onclick="closePopup()">닫기</div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function closePopup() {
            document.getElementById('resume-popup').style.display = 'none';
        }

        $(document).ready(function() {
            $('.resume-link').click(function() {
                var resumeId = $(this).data('resume-id');
                $.ajax({
                    url: 'get_resume.php',
                    type: 'GET',
                    data: { resume_id: resumeId },
                    success: function(data) {
                        $('#resume-content').html(data);
                        $('#resume-popup').css('display', 'block');
                    },
                    error: function() {
                        alert('이력서 정보를 불러오는데 실패했습니다.');
                    }
                });
            });
        });
    </script>
</body>
</html>
