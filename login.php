<?php
session_start();

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
    $memberid = $_POST['memberid'];
    $pass = $_POST['password'];

    $sql = "SELECT password FROM membertbl WHERE memberid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $memberid);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($pass, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['memberid'] = $memberid;
            echo '<script>
                alert("로그인 되었습니다.");
                window.location.href = "main.php";
                </script>';
        } else {
            echo '<script>
                alert("비밀번호가 일치하지 않습니다..");
                window.history.back();
                </script>';
        }
    } else {
        echo '<script>
            alert("아이디가 존재하지 않습니다.");
            window.history.back();
            </script>';
    }

    $stmt->close();
}

$conn->close();
?>
