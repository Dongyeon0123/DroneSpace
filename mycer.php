<?php
session_start();

// 로그인 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

require_once 'db.php';

// 세션에서 사용자 ID 가져오기
$memberid = $_SESSION['memberid'];

// 이력서 목록 조회
$resumes = [];
if ($stmt = $conn->prepare("SELECT resume_id, name, birthdate, phone, address, education_level, university_name, certifications, experience, resume_photo FROM resumes WHERE memberid = ?")) {
    $stmt->bind_param("s", $memberid);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $resumes[] = $row;
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
    <title>내 이력서 목록</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="main.css">
    <style>
        .resume-list {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .resume-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            margin-bottom: 10px;
        }
        .resume-item:last-child {
            border-bottom: none;
        }
        .resume-item h3 {
            margin: 0;
        }
        .resume-item p {
            margin: 5px 0;
        }
        .resume-item img {
            width: 120px;
            height: 150px;
            border-radius: 8px;
            margin-top: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }

        /* 폼 스타일링 */
        form {
            background-color: white;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="tel"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* padding을 포함한 너비를 100%로 계산 */
            margin-bottom: 10px;
        }

        textarea {
            height: 100px;
            resize: vertical; /* 사용자가 세로 크기 조절 가능 */
        }
        
        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .create-button {
            background-color: #5C67F2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .create-button:hover {
            background-color: #4a54e1;
        }

        .edit-button {
            background-color: #5C67F2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 530px;
            margin-right: 10px;
        }

        .edit-button:hover {
            background-color: #4a54e1; /* 버튼 호버 효과 */
        }

        /* 경력 추가 버튼 스타일 */
        #experience-container button {
            margin-top: 10px;
            background-color: #4CAF50;
        }

        #experience-container div {
            background-color: #e7e7e7;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
        }

        /* 삭제 버튼 스타일 */
        .delete-button {
            background-color: #FF4B4B;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-button:hover {
            background-color: #D43F3F; /* 삭제 버튼 호버 효과 */
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="main.php"><img src="logo.png"></a>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>
    <h1>내 이력서 목록</h1>
    <div class="button-container">
        <button class="create-button" onclick="location.href='mycer.html'">이력서 작성</button>
    </div>
    <div class="resume-list">
        <?php if (empty($resumes)): ?>
            <p>등록된 이력서가 없습니다.</p>
        <?php else: ?>
            <?php foreach ($resumes as $resume): ?>
            <div class="resume-item">
                <h3 style="font-size:24px;"><?= htmlspecialchars($resume['name']); ?></h3>
                <span>생년월일: <?= htmlspecialchars($resume['birthdate']); ?></span><br>
                <span>연락처: <?= htmlspecialchars($resume['phone']); ?></span><br>
                <span>주소: <?= htmlspecialchars($resume['address']); ?></span><br>
                <span>학력: <?= htmlspecialchars($resume['education_level']); ?></span><br>
                <?php if ($resume['university_name']): ?>
                <span>대학교명: <?= htmlspecialchars($resume['university_name']); ?></span><br>
                <?php endif; ?>
                <span>자격증: <?= htmlspecialchars($resume['certifications']); ?></span><br>
                <span>경력:
                    <?php 
                    $experience = json_decode($resume['experience'], true);
                    foreach ($experience as $exp) {
                        echo htmlspecialchars($exp['company']) . " (" . htmlspecialchars($exp['period']) . ") - " . htmlspecialchars($exp['duties']) . "<br>";
                    }
                    ?>
                </span><br>
                <?php if ($resume['resume_photo']): ?>
                    <img src="<?= htmlspecialchars($resume['resume_photo']); ?>" alt="이력서 사진">
                <?php endif; ?>
                <button class="edit-button" onclick="location.href='edit_resume.php?id=<?= $resume['resume_id']; ?>'">수정</button>
                <button class="delete-button" onclick="deleteResume(<?= $resume['resume_id']; ?>)">삭제</button>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="menu-overlay" id="menuOverlay">
        <div class="image-container">
            <a href="main.php"><img src="logo.png"></a>
        </div>
        <div class="menu-overlay-content">
            <span class="close-btn" onclick="closeMenu()">X</span>
            <div>
                <h2>기업 소개</h2>
                    <ul>
                        <li><a href="hello.php">인사말</a></li>
                        <li><a href="history.php">DroneSpace 연혁</a></li>
                        <li><a href="vision.php">아카데미 비전</a></li>
                        <li><a href="facility.php">시설 현황</a></li>
                        <li><a href="map.php">오시는 길</a></li>
                    </ul>
            </div>
            <div>
                <h2>국가 자격증</h2>
                    <ul>
                        <li><a href="information.php">국가 자격증 안내</a></li>
                        <li><a href="money.php">교육비 지원 안내</a></li>
                        <li><a href="company.php">기관/단체 교육 안내</a></li>
                        <li><a href="type1.php">1종 조종자 과정</li></a>
                        <li><a href="type2.php">2종 조종자 과정</li></a>
                        <li><a href="type3.php">3종 조종자 과정</li></a>
                        <li><a href="education.php">드론 운용자 교육</a></li>
                        <li><a href="instructor.php">지도 조종자 과정</a></li>
                        <li><a href="practical.php">실기 평가자 과정</a></li>
                    </ul>
            </div>
            <div>
                <h2>구인 & 구직</h2>
                    <ul>
                        <li><a href="area.php">지역별</a></li>
                        <li><a href="certificate.php">자격증별</a></li>
                    </ul>
            </div>
            <div>
                <h2>커뮤니티</h2>
                    <ul>
                        <li><a href="everything.php">전체글</a></li>
                        <li><a href="hot.php">HOT글</a></li>
                        <li><a href="ask.php">1대1 질문 게시판</a></li>
                    </ul>
            </div>
            <div style="margin-top: 24px;">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" style="color: white; font-size: 24px;">로그아웃</a>
                <?php else: ?>
                    <a href="login.html" style="color: white; font-size: 24px;">로그인 / 회원가입</a>
                <?php endif; ?>
            </div>
            <div>
                <h2 style="color: red;">마이 페이지</h2>
                    <ul>
                        <li><a href="mywrite.php">내가 작성한 게시글</a></li>
                        <li><a href="myreply.php">내가 작성한 댓글</a></li>
                        <li><a href="application.php">구인&구직 신청 현황</a></li>
                        <li><a href="mycer.php">내 이력서</a></li>
                    </ul>
            </div>
        </div>
    </div>
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

        function deleteResume(resume_id) {
            if (confirm('정말 삭제하시겠습니까?')) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_resume.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            alert('이력서가 성공적으로 삭제되었습니다.');
                            location.reload();
                        } else {
                            alert('이력서 삭제에 실패했습니다: ' + response.message);
                        }
                    }
                };
                xhr.send("id=" + resume_id);
            }
        }
    </script>
</body>
</html>
