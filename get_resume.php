<?php
require_once 'db.php';

if (!isset($_GET['resume_id'])) {
    echo "잘못된 접근입니다.";
    exit;
}

$resume_id = $_GET['resume_id'];

$stmt = $conn->prepare("SELECT * FROM resumes WHERE resume_id = ?");
$stmt->bind_param("i", $resume_id);
$stmt->execute();
$result = $stmt->get_result();
$resume = $result->fetch_assoc();
$stmt->close();
$conn->close();

if ($resume) {
    echo "<p><strong>이름:</strong> " . htmlspecialchars($resume['name']) . "</p>";
    echo "<p><strong>생년월일:</strong> " . htmlspecialchars($resume['birthdate']) . "</p>";
    echo "<p><strong>연락처:</strong> " . htmlspecialchars($resume['phone']) . "</p>";
    echo "<p><strong>주소:</strong> " . htmlspecialchars($resume['address']) . "</p>";
    echo "<p><strong>학력:</strong> " . htmlspecialchars($resume['education_level']) . "</p>";
    if (!empty($resume['university_name'])) {
        echo "<p><strong>대학교명:</strong> " . htmlspecialchars($resume['university_name']) . "</p>";
    }
    echo "<p><strong>자격증:</strong> " . htmlspecialchars($resume['certifications']) . "</p>";
    echo "<p><strong>경력:</strong><br>";
    $experience = json_decode($resume['experience'], true);
    foreach ($experience as $exp) {
        echo htmlspecialchars($exp['company']) . " (" . htmlspecialchars($exp['period']) . ") - " . htmlspecialchars($exp['duties']) . "<br>";
    }
    echo "</p>";
    if (!empty($resume['resume_photo'])) {
        echo "<img src='" . htmlspecialchars($resume['resume_photo']) . "' alt='이력서 사진' style='width:120px;height:150px;border-radius:8px;margin-top:20px;'>";
    }
} else {
    echo "이력서 정보를 찾을 수 없습니다.";
}
?>
