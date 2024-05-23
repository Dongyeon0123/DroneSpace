<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "skso1951";
$dbname = "dbwork";

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$memberid = $_SESSION['memberid'];

// 사용자의 이력서 목록 조회
$resumes = [];
$stmt = $conn->prepare("SELECT id, name, birthdate, phone, address, education_level, university_name, certifications, experience, resume_photo FROM resumes WHERE memberid = ?");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $memberid);

if ($stmt->execute() === false) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();
if ($result === false) {
    die("Get result failed: " . $stmt->error);
}

while ($row = $result->fetch_assoc()) {
    $resumes[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>내 이력서 목록</title>
    <link rel="stylesheet" href="styles.css"> <!-- 스타일 시트 링크 -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .resume-list {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .resume-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .resume-item:last-child {
            border-bottom: none;
        }

        .resume-item h3 {
            margin: 0 0 10px 0;
        }

        .resume-item p {
            margin: 5px 0;
        }

        .resume-item img {
            max-width: 150px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .resume-item button {
            background-color: #5C67F2;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        .resume-item button:hover {
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
                    <h3><?php echo htmlspecialchars($resume['name']); ?></h3>
                    <p>생년월일: <?php echo htmlspecialchars($resume['birthdate']); ?></p>
                    <p>연락처: <?php echo htmlspecialchars($resume['phone']); ?></p>
                    <p>주소: <?php echo htmlspecialchars($resume['address']); ?></p>
                    <p>학력: <?php echo htmlspecialchars($resume['education_level']); ?></p>
                    <?php if ($resume['university_name']): ?>
                        <p>대학교명: <?php echo htmlspecialchars($resume['university_name']); ?></p>
                    <?php endif; ?>
                    <p>자격증: <?php echo htmlspecialchars($resume['certifications']); ?></p>
                    <p>경력: 
                        <?php 
                        $experience = json_decode($resume['experience'], true);
                        if (is_array($experience)) {
                            foreach ($experience as $exp) {
                                echo '회사명: ' . htmlspecialchars($exp['company']) . ', 근무 기간: ' . htmlspecialchars($exp['period']) . ', 담당 업무: ' . htmlspecialchars($exp['duties']) . '<br>';
                            }
                        }
                        ?>
                    </p>
                    <?php if ($resume['resume_photo']): ?>
                        <img src="<?php echo htmlspecialchars($resume['resume_photo']); ?>" alt="이력서 사진">
                    <?php endif; ?>
                    <form action="edit_resume.php" method="GET" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $resume['id']; ?>">
                        <button type="submit">수정</button>
                    </form>
                    <form action="delete_resume.php" method="POST" style="display:inline;" onsubmit="return confirm('정말 삭제하시겠습니까?');">
                        <input type="hidden" name="id" value="<?php echo $resume['id']; ?>">
                        <button type="submit" class="delete-button">삭제</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
