<?php
session_start();

// 로그인 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "skso1951";
$dbname = "dbwork";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1 {
            text-align: center;
        }
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
            max-width: 100px;
            border-radius: 8px;
        }
        button {
            padding: 5px 10px;
            background-color: #5C67F2;
            color: white;
            border: none;
            border-radius: 4px;
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
    </style>
</head>
<body>
    <h1>내 이력서 목록</h1>
    <div class="resume-list">
        <?php if (empty($resumes)): ?>
            <p>등록된 이력서가 없습니다.</p>
        <?php else: ?>
            <?php foreach ($resumes as $resume): ?>
            <div class="resume-item">
                <h3><?= htmlspecialchars($resume['name']); ?></h3>
                <p>생년월일: <?= htmlspecialchars($resume['birthdate']); ?></p>
                <p>연락처: <?= htmlspecialchars($resume['phone']); ?></p>
                <p>주소: <?= htmlspecialchars($resume['address']); ?></p>
                <p>학력: <?= htmlspecialchars($resume['education_level']); ?></p>
                <?php if ($resume['university_name']): ?>
                <p>대학교명: <?= htmlspecialchars($resume['university_name']); ?></p>
                <?php endif; ?>
                <p>자격증: <?= htmlspecialchars($resume['certifications']); ?></p>
                <p>경력:
                    <?php 
                    $experience = json_decode($resume['experience'], true);
                    foreach ($experience as $exp) {
                        echo htmlspecialchars($exp['company']) . " (" . htmlspecialchars($exp['period']) . ") - " . htmlspecialchars($exp['duties']) . "<br>";
                    }
                    ?>
                </p>
                <?php if ($resume['resume_photo']): ?>
                <img src="<?= htmlspecialchars($resume['resume_photo']); ?>" alt="이력서 사진">
                <?php endif; ?>
                <button onclick="location.href='edit_resume.php?id=<?= $resume['id']; ?>'">수정</button>
                <button class="delete-button" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='delete_resume.php?id=<?= $resume['id']; ?>'">삭제</button>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
