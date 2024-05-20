<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// 연결 시 UTF-8 설정
$conn->set_charset("utf8");

// 폼 데이터 받기
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $memberid = $_POST['memberid'];
    $pass = $_POST['password'];

    // 데이터 유효성 검사
    if (empty($memberid) || empty($pass)) {
        die("모든 필드를 채워주세요.");
    }

    // SQL 문 작성
    $sql = "SELECT password FROM membertbl WHERE memberid = ?";

    // 준비된 문장 준비
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $memberid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // 결과에서 첫 번째 행 가져오기
        $row = $result->fetch_assoc();

        // 비밀번호 검증
        if (password_verify($pass, $row['password'])) {
            echo "로그인 성공! 환영합니다.";
            // 세션 시작
            session_start();
            $_SESSION['memberid'] = $memberid;
            // 원하는 페이지로 리디렉션
            header("Location: welcome.php");
            exit();
        } else {
            echo "비밀번호가 잘못되었습니다.";
        }
    } else {
        echo "회원 ID가 존재하지 않습니다.";
    }

    // 연결 종료
    $stmt->close();
} else {
    echo "잘못된 요청입니다.";
}

$conn->close();
?>
