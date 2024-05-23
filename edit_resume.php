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

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

if (!isset($_GET['id'])) {
    echo "<script>alert('잘못된 접근입니다.'); window.location.href='mycer.php';</script>";
    exit;
}

$resume_id = $_GET['id'];

// 이력서 데이터 조회
$stmt = $conn->prepare("SELECT id, name, birthdate, phone, address, education_level, university_name, certifications, experience, resume_photo FROM resumes WHERE id = ? AND memberid = ?");
$stmt->bind_param("is", $resume_id, $_SESSION['memberid']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('이력서를 찾을 수 없습니다.'); window.location.href='mycer.php';</script>";
    exit;
}

$resume = $result->fetch_assoc();
$experience = json_decode($resume['experience'], true);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>이력서 수정</title>
    <link rel="stylesheet" href="styles.css"> <!-- 스타일 시트 링크 -->
    <style>
        /* 전체 페이지 스타일링 */
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

        /* 폼 스타일링 */
        form {
            background-color: white;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        div {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="tel"],
        textarea {
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

        button {
            background-color: #5C67F2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
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

        .delete-button {
            background-color: #FF4B4B;
        }

        .delete-button:hover {
            background-color: #D43F3F;
        }
    </style>
</head>
<body>
    <h1>이력서 수정</h1>
    <form action="update_resume.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $resume['id']; ?>">
        <div>
            <label for="name">이름:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($resume['name']); ?>" required>
        </div>
        <div>
            <label for="birthdate">생년월일:</label>
            <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($resume['birthdate']); ?>" required>
        </div>
        <div>
            <label for="phone">연락처:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($resume['phone']); ?>" required>
        </div>
        <div>
            <label for="address">주소:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($resume['address']); ?>" required>
        </div>
        <div>
            <label for="education">학력:</label>
            <select id="education" name="education" onchange="toggleUniversityName()">
                <option value="고졸" <?php if ($resume['education_level'] === '고졸') echo 'selected'; ?>>고졸</option>
                <option value="2,3년제 대학 재학" <?php if ($resume['education_level'] === '2,3년제 대학 재학') echo 'selected'; ?>>2,3년제 대학 재학</option>
                <option value="4년제 대학 재학" <?php if ($resume['education_level'] === '4년제 대학 재학') echo 'selected'; ?>>4년제 대학 재학</option>
                <option value="2,3년제 대학 졸업" <?php if ($resume['education_level'] === '2,3년제 대학 졸업') echo 'selected'; ?>>2,3년제 대학 졸업</option>
                <option value="4년제 대학 졸업" <?php if ($resume['education_level'] === '4년제 대학 졸업') echo 'selected'; ?>>4년제 대학 졸업</option>
            </select>
        </div>
        <div id="university-name" style="display: <?php echo ($resume['education_level'] === '2,3년제 대학 재학' || $resume['education_level'] === '4년제 대학 재학') ? 'block' : 'none'; ?>;">
            <label for="university_name">대학교명:</label>
            <input type="text" id="university_name" name="university_name" value="<?php echo htmlspecialchars($resume['university_name']); ?>">
        </div>
        <div>
            <label for="certifications">자격증 보유 현황:</label>
            <input type="checkbox" id="cert1" name="certifications[]" value="1종 드론 국가자격증" <?php if (strpos($resume['certifications'], '1종 드론 국가자격증') !== false) echo 'checked'; ?>>
            <label for="cert1">1종 드론 국가자격증</label>
            <input type="checkbox" id="cert2" name="certifications[]" value="2종 드론 국가자격증" <?php if (strpos($resume['certifications'], '2종 드론 국가자격증') !== false) echo 'checked'; ?>>
            <label for="cert2">2종 드론 국가자격증</label>
            <input type="checkbox" id="cert3" name="certifications[]" value="3종 드론 국가자격증" <?php if (strpos($resume['certifications'], '3종 드론 국가자격증') !== false) echo 'checked'; ?>>
            <label for="cert3">3종 드론 국가자격증</label>
        </div>
        <div id="experience-container">
            <label for="experience">경력:</label>
            <button type="button" onclick="addExperience()">경력 추가</button>
            <?php foreach ($experience as $exp): ?>
                <div>
                    <input type="text" placeholder="회사명" name="company[]" value="<?php echo htmlspecialchars($exp['company']); ?>">
                    <input type="text" placeholder="근무 기간(N년)" name="period[]" value="<?php echo htmlspecialchars($exp['period']); ?>">
                    <input type="text" placeholder="담당 업무" name="duties[]" value="<?php echo htmlspecialchars($exp['duties']); ?>">
                    <button type="button" class="delete-button" onclick="removeExperience(this)">삭제</button>
                </div>
            <?php endforeach; ?>
        </div>
        <div>
            <label for="resume_photo">이력서 사진:</label>
            <input type="file" id="resume_photo" name="resume_photo">
            <?php if ($resume['resume_photo']): ?>
                <img src="<?php echo htmlspecialchars($resume['resume_photo']); ?>" alt="이력서 사진" style="max-width: 150px; border-radius: 8px; margin-top: 10px;">
            <?php endif; ?>
        </div>
        <button type="submit">수정</button>
    </form>

    <script>
        function toggleUniversityName() {
            const educationSelect = document.getElementById('education');
            const universityNameDiv = document.getElementById('university-name');
            if (educationSelect.value === '2,3년제 대학 재학' || educationSelect.value === '4년제 대학 재학') {
                universityNameDiv.style.display = 'block';
            } else {
                universityNameDiv.style.display = 'none';
            }
        }

        function addExperience() {
            const container = document.getElementById('experience-container');
            const newExp = document.createElement('div');
            newExp.innerHTML = `
                <input type="text" placeholder="회사명" name="company[]">
                <input type="text" placeholder="근무 기간(N년)" name="period[]">
                <input type="text" placeholder="담당 업무" name="duties[]">
                <button type="button" class="delete-button" onclick="removeExperience(this)">삭제</button>
            `;
            container.appendChild(newExp);
        }

        function removeExperience(button) {
            const expDiv = button.parentNode;
            expDiv.parentNode.removeChild(expDiv);
        }
    </script>
</body>
</html>
