<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "skso1951";
$dbname = "workdb";

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 연결 시 UTF-8 설정
$conn->set_charset("utf8");

// 폼 데이터 받기
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $memberid = $_POST['memberid'];
    $pass = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $license = $_POST['license'];

    // 파일 업로드 처리
    $uploads_dir = 'uploads';
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }

    $licenseImagePath = $identificationPhotoPath = null;

    if (isset($_FILES['licenseImage']) && $_FILES['licenseImage']['error'] == UPLOAD_ERR_OK) {
        $licenseImage = $_FILES['licenseImage'];
        $licenseImagePath = $uploads_dir . '/' . basename($licenseImage['name']);
        move_uploaded_file($licenseImage['tmp_name'], $licenseImagePath);
    }

    if (isset($_FILES['identificationPhoto']) && $_FILES['identificationPhoto']['error'] == UPLOAD_ERR_OK) {
        $identificationPhoto = $_FILES['identificationPhoto'];
        $identificationPhotoPath = $uploads_dir . '/' . basename($identificationPhoto['name']);
        move_uploaded_file($identificationPhoto['tmp_name'], $identificationPhotoPath);
    }

    // 데이터 유효성 검사
    if (empty($memberid) || empty($pass) || empty($name) || empty($email) || empty($dob) || empty($identificationPhotoPath)) {
        die("모든 필드를 채워주세요.");
    }

    // 비밀번호 해시화
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // SQL 문 작성
    $sql = "INSERT INTO membertbl (memberid, password, name, email, birth, cernum, license_image, identification_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // 준비된 문장 준비
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssss", $memberid, $hashed_password, $name, $email, $dob, $license, $licenseImagePath, $identificationPhotoPath);

    // 실행 및 결과 확인
    if ($stmt->execute()) {
        echo "새로운 레코드가 성공적으로 생성되었습니다.";
    } else {
        echo "오류: " . $stmt->error;
    }

    // 연결 종료
    $stmt->close();
} else {
    echo "잘못된 요청입니다.";
}

$conn->close();
?>