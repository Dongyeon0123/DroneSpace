<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

require_once 'db.php';

$memberid = $_SESSION['memberid'];
$name = $_POST['name'];
$birthdate = $_POST['birthdate'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$education_level = $_POST['education'];
$university_name = isset($_POST['university_name']) ? $_POST['university_name'] : null;
$certifications = isset($_POST['certifications']) ? implode(", ", $_POST['certifications']) : "";
$experience = [];

if (isset($_POST['company'])) {
    for ($i = 0; $i < count($_POST['company']); $i++) {
        $experience[] = [
            'company' => $_POST['company'][$i],
            'period' => $_POST['period'][$i],
            'duties' => $_POST['duties'][$i],
        ];
    }
}

$experience_json = json_encode($experience);
$resume_photo = null;

if (isset($_FILES['resume_photo']) && $_FILES['resume_photo']['error'] == UPLOAD_ERR_OK) {
    $resume_photo = 'uploads/' . basename($_FILES['resume_photo']['name']);
    move_uploaded_file($_FILES['resume_photo']['tmp_name'], $resume_photo);
}

$stmt = $conn->prepare("INSERT INTO resumes (memberid, name, birthdate, phone, address, education_level, university_name, certifications, experience, resume_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $memberid, $name, $birthdate, $phone, $address, $education_level, $university_name, $certifications, $experience_json, $resume_photo);

if ($stmt->execute()) {
    echo "<script>alert('이력서가 성공적으로 제출되었습니다.'); window.location.href='mycer.php';</script>";
} else {
    echo "<script>alert('이력서 제출 중 오류가 발생했습니다.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
