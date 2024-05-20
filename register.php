<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("log_errors", 1);
ini_set("error_log", "php-error.log");

// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "skso1951";
$dbname = "dbwork";

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}

// 연결 시 UTF-8 설정
$conn->set_charset("utf8");

// 폼 데이터 받기
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_log("Form submitted");

    // 폼 데이터 수집
    $memberid = $_POST['memberid'];
    $pass = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cernum = isset($_POST['cernum']) && $_POST['cernum'] !== '' ? $_POST['cernum'] : null;

    // 데이터 로그
    error_log("Received data: memberid=$memberid, name=$name, email=$email, cernum=$cernum");

    // 파일 업로드 처리
    $uploads_dir = 'uploads';

    // uploads 디렉토리가 존재하는지 확인
    if (!is_dir($uploads_dir)) {
        error_log("uploads 디렉토리가 존재하지 않습니다.");
        die("uploads 디렉토리가 존재하지 않습니다.");
    }

    $licenseImagePath = $identificationPhotoPath = null;

    // 자격증 이미지 파일 업로드 처리
    if (isset($_FILES['licenseImage']) && $_FILES['licenseImage']['error'] == UPLOAD_ERR_OK) {
        $licenseImage = $_FILES['licenseImage'];
        $licenseImagePath = $uploads_dir . '/' . basename($licenseImage['name']);
        if (!move_uploaded_file($licenseImage['tmp_name'], $licenseImagePath)) {
            error_log("Failed to upload license image.");
            die("Failed to upload license image.");
        }
        error_log("License image uploaded to: $licenseImagePath");
    }

    // 본인 인증 사진 업로드 처리
    if (isset($_FILES['identificationPhoto']) && $_FILES['identificationPhoto']['error'] == UPLOAD_ERR_OK) {
        $identificationPhoto = $_FILES['identificationPhoto'];
        $identificationPhotoPath = $uploads_dir . '/' . basename($identificationPhoto['name']);
        if (!move_uploaded_file($identificationPhoto['tmp_name'], $identificationPhotoPath)) {
            error_log("Failed to upload identification photo.");
            die("Failed to upload identification photo.");
        }
        error_log("Identification photo uploaded to: $identificationPhotoPath");
    }

    // 데이터 유효성 검사
    if (empty($memberid) || empty($pass) || empty($name) || empty($email) || empty($identificationPhotoPath)) {
        error_log("모든 필드를 채워주세요.");
        die("모든 필드를 채워주세요.");
    }

    // 중복된 아이디 확인
    $check_sql = "SELECT memberid FROM membertbl WHERE memberid = ?";
    $check_stmt = $conn->prepare($check_sql);
    if ($check_stmt === false) {
        error_log("Prepare failed: " . $conn->error);
        die("Prepare failed: " . $conn->error);
    }
    $check_stmt->bind_param("s", $memberid);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        error_log("이미 존재하는 아이디입니다.");
        die("이미 존재하는 아이디입니다.");
    }
    $check_stmt->close();

    // 비밀번호 해시화
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // SQL 문 작성 (cernum 필드를 포함)
    $sql = "INSERT INTO membertbl (memberid, password, name, email, cernum, license_image, identification_photo) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // 준비된 문장 준비
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        error_log("Prepare failed: " . $conn->error);
        die("Prepare failed: " . $conn->error);
    }

    // 데이터 바인딩 및 실행
    $stmt->bind_param("ssssiss", $memberid, $hashed_password, $name, $email, $cernum, $licenseImagePath, $identificationPhotoPath);

    // 실행 및 결과 확인
    if ($stmt->execute()) {
        error_log("새로운 레코드가 성공적으로 생성되었습니다.");
        echo "새로운 레코드가 성공적으로 생성되었습니다.";
    } else {
        error_log("오류: " . $stmt->error);
        echo "오류: " . $stmt->error;
    }

    // 연결 종료
    $stmt->close();
} else {
    error_log("잘못된 요청입니다.");
    echo "잘못된 요청입니다.";
}

$conn->close();
?>
