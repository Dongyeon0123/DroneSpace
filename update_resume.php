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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resume_id = $_POST['id'];
    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $education_level = $_POST['education'];
    $university_name = isset($_POST['university_name']) ? $_POST['university_name'] : null;
    $certifications = implode(", ", $_POST['certifications']);
    $experience = json_encode(array_map(function ($company, $period, $duties) {
        return ['company' => $company, 'period' => $period, 'duties' => $duties];
    }, $_POST['company'], $_POST['period'], $_POST['duties']));

    $resume_photo = null;
    if (isset($_FILES['resume_photo']) && $_FILES['resume_photo']['error'] == UPLOAD_ERR_OK) {
        $uploads_dir = 'uploads';
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }
        $resume_photo = $uploads_dir . '/' . basename($_FILES['resume_photo']['name']);
        if (!move_uploaded_file($_FILES['resume_photo']['tmp_name'], $resume_photo)) {
            echo "<script>alert('이력서 사진 업로드에 실패했습니다.'); window.history.back();</script>";
            exit;
        }
    }

    $sql = "UPDATE resumes SET name = ?, birthdate = ?, phone = ?, address = ?, education_level = ?, university_name = ?, certifications = ?, experience = ?";
    if ($resume_photo) {
        $sql .= ", resume_photo = ?";
    }
    $sql .= " WHERE id = ? AND memberid = ?";

    $stmt = $conn->prepare($sql);
    if ($resume_photo) {
        $stmt->bind_param("ssssssssssis", $name, $birthdate, $phone, $address, $education_level, $university_name, $certifications, $experience, $resume_photo, $resume_id, $_SESSION['memberid']);
    } else {
        $stmt->bind_param("sssssssssi", $name, $birthdate, $phone, $address, $education_level, $university_name, $certifications, $experience, $resume_id, $_SESSION['memberid']);
    }

    if ($stmt->execute()) {
        echo "<script>alert('이력서가 성공적으로 수정되었습니다.'); window.location.href='mycer.php';</script>";
    } else {
        echo "<script>alert('이력서 수정에 실패했습니다.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
