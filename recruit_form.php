<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $memberid = $_SESSION['memberid'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $region = implode(', ', $_POST['region']);
    $qualifications = implode(', ', $_POST['qualifications']);
    $company_name = $_POST['company_name'];
    $working_hours_start = $_POST['working_hours_start'];
    $working_hours_end = $_POST['working_hours_end'];
    $working_period = $_POST['working_period'];
    $contact_name = $_POST['contact_name'];
    $contact_phone = $_POST['contact_phone'];
    $contact_email = $_POST['contact_email'];

    $stmt = $conn->prepare("INSERT INTO recruitment (memberid, title, description, region, qualifications, company_name, working_hours_start, working_hours_end, working_period, contact_name, contact_phone, contact_email, postdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssssssssssss", $memberid, $title, $description, $region, $qualifications, $company_name, $working_hours_start, $working_hours_end, $working_period, $contact_name, $contact_phone, $contact_email);

    if ($stmt->execute()) {
        echo "<script>alert('구인글이 작성되었습니다.'); window.location.href='recruitment.php';</script>";
    } else {
        echo "<script>alert('구인글 작성에 실패했습니다.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>구인글 작성</title>
    <link rel="stylesheet" href="main.css">
    <style>
        .container {
            width: 60%;
            margin: auto;
            overflow: hidden;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #4A54E1;
        }
        form div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
        }
        fieldset {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }
        legend {
            font-weight: bold;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5C67F2;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #4a54e1;
        }
    </style>
</head>
<body>
    <?php require_once 'header.php'; ?>
    <div class="container">
        <h1>구인글 작성</h1>
        <form action="recruit_form.php" method="post">
            <div>
                <label for="title">제목</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="description">설명</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div>
                <label for="region">구인 지역</label>
                <fieldset>
                    <legend>지역 선택</legend>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="region[]" value="서울"> 서울</label>
                        <label><input type="checkbox" name="region[]" value="경기/인천"> 경기/인천</label>
                        <label><input type="checkbox" name="region[]" value="강원도"> 강원도</label>
                        <label><input type="checkbox" name="region[]" value="충청도"> 충청도</label>
                        <label><input type="checkbox" name="region[]" value="경상도"> 경상도</label>
                        <label><input type="checkbox" name="region[]" value="전라도"> 전라도</label>
                        <label><input type="checkbox" name="region[]" value="제주"> 제주</label>
                    </div>
                </fieldset>
            </div>
            <div>
                <label for="qualifications">우대 자격증</label>
                <fieldset>
                    <legend>우대 자격증</legend>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="qualifications[]" value="1종 드론 국가자격증"> 1종 드론 국가자격증</label>
                        <label><input type="checkbox" name="qualifications[]" value="2종 드론 국가자격증"> 2종 드론 국가자격증</label>
                        <label><input type="checkbox" name="qualifications[]" value="3종 드론 국가자격증"> 3종 드론 국가자격증</label>
                        <label><input type="checkbox" name="qualifications[]" value="4종 드론 국가자격증"> 4종 드론 국가자격증</label>
                        <label><input type="checkbox" name="qualifications[]" value="초경량 비행장치 조종 자격증"> 초경량 비행장치 조종 자격증</label>
                        <label><input type="checkbox" name="qualifications[]" value="드론 교관 자격증"> 드론 교관 자격증</label>
                        <label><input type="checkbox" name="qualifications[]" value="드론 실기평가 조종자 자격증"> 드론 실기평가 조종자 자격증</label>
                    </div>
                </fieldset>
            </div>
            <div>
                <label for="company_name">기업 명</label>
                <input type="text" id="company_name" name="company_name" required>
            </div>
            <div>
                <label for="working_hours_start">근무 시간 시작</label>
                <input type="time" id="working_hours_start" name="working_hours_start" required>
            </div>
            <div>
                <label for="working_hours_end">근무 시간 종료</label>
                <input type="time" id="working_hours_end" name="working_hours_end" required>
            </div>
            <div>
                <label for="working_period">근무 기간</label>
                <input type="text" id="working_period" name="working_period" required>
            </div>
            <div>
                <label for="contact_name">이름</label>
                <input type="text" id="contact_name" name="contact_name" required>
            </div>
            <div>
                <label for="contact_phone">연락처</label>
                <input type="text" id="contact_phone" name="contact_phone" required>
            </div>
            <div>
                <label for="contact_email">이메일</label>
                <input type="email" id="contact_email" name="contact_email" required>
            </div>
            <button type="submit">작성</button>
        </form>
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
    </script>
</body>
</html>
