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
$stmt = $conn->prepare("SELECT * FROM recruitment WHERE recruitnum = ?");
$stmt->bind_param("i", $recruitnum);
$stmt->execute();
$result = $stmt->get_result();
$recruit = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    $stmt = $conn->prepare("UPDATE recruitment SET title = ?, description = ?, region = ?, qualifications = ?, company_name = ?, working_hours_start = ?, working_hours_end = ?, working_period = ?, contact_name = ?, contact_phone = ?, contact_email = ? WHERE recruitnum = ?");
    $stmt->bind_param("sssssssssssi", $title, $description, $region, $qualifications, $company_name, $working_hours_start, $working_hours_end, $working_period, $contact_name, $contact_phone, $contact_email, $recruitnum);

    if ($stmt->execute()) {
        echo "<script>alert('구인글이 수정되었습니다.'); window.location.href='recruitment.php';</script>";
    } else {
        echo "<script>alert('구인글 수정에 실패했습니다.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>구인글 수정</title>
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
        <h1>구인글 수정</h1>
        <form action="edit_recruit_form.php?recruitnum=<?= $recruitnum ?>" method="post">
            <div>
                <label for="title">제목</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($recruit['title']) ?>" required>
            </div>
            <div>
                <label for="description">설명</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($recruit['description']) ?></textarea>
            </div>
            <div>
                <label for="region">구인 지역</label>
                <fieldset>
                    <legend>지역 선택</legend>
                    <?php
                    $regions = ['서울', '경기/인천', '강원도', '충청도', '경상도', '전라도', '제주'];
                    $selected_regions = explode(', ', $recruit['region']);
                    foreach ($regions as $region) {
                        $checked = in_array($region, $selected_regions) ? 'checked' : '';
                        echo "<input type='checkbox' name='region[]' value='$region' $checked> $region ";
                    }
                    ?>
                </fieldset>
            </div>
            <div>
                <label for="qualifications">보유 자격증</label>
                <fieldset>
                    <legend>자격증 보유 현황</legend>
                    <?php
                    $qualifications = [
                        '1종 드론 국가자격증', '2종 드론 국가자격증', '3종 드론 국가자격증', 
                        '4종 드론 국가자격증', '초경량 비행장치 조종 자격증', '드론 교관 자격증', 
                        '드론 실기평가 조종자 자격증'
                    ];
                    $selected_qualifications = explode(', ', $recruit['qualifications']);
                    foreach ($qualifications as $qualification) {
                        $checked = in_array($qualification, $selected_qualifications) ? 'checked' : '';
                        echo "<input type='checkbox' name='qualifications[]' value='$qualification' $checked> $qualification<br>";
                    }
                    ?>
                </fieldset>
            </div>
            <div>
                <label for="company_name">기업 명</label>
                <input type="text" id="company_name" name="company_name" value="<?= htmlspecialchars($recruit['company_name']) ?>" required>
            </div>
            <div>
                <label for="working_hours_start">근무 시작 시간</label>
                <input type="time" id="working_hours_start" name="working_hours_start" value="<?= htmlspecialchars($recruit['working_hours_start']) ?>" required>
            </div>
            <div>
                <label for="working_hours_end">근무 종료 시간</label>
                <input type="time" id="working_hours_end" name="working_hours_end" value="<?= htmlspecialchars($recruit['working_hours_end']) ?>" required>
            </div>
            <div>
                <label for="working_period">근무 기간</label>
                <input type="text" id="working_period" name="working_period" value="<?= htmlspecialchars($recruit['working_period']) ?>" required>
            </div>
            <div>
                <label for="contact_name">이름</label>
                <input type="text" id="contact_name" name="contact_name" value="<?= htmlspecialchars($recruit['contact_name']) ?>" required>
            </div>
            <div>
                <label for="contact_phone">연락처</label>
                <input type="text" id="contact_phone" name="contact_phone" value="<?= htmlspecialchars($recruit['contact_phone']) ?>" required>
            </div>
            <div>
                <label for="contact_email">이메일</label>
                <input type="email" id="contact_email" name="contact_email" value="<?= htmlspecialchars($recruit['contact_email']) ?>" required>
            </div>
            <button type="submit">수정</button>
        </form>
    </div>
</body>
</html>
