<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recruitnum = $_POST['recruitnum'];
    $memberid = $_SESSION['memberid'];
    $resume_id = $_POST['resume_id'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO applications (recruitnum, memberid, resume_id, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $recruitnum, $memberid, $resume_id, $message);

    if ($stmt->execute()) {
        echo "<script>alert('신청이 완료되었습니다.'); window.close();</script>";
    } else {
        echo "<script>alert('신청에 실패했습니다.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
    exit;
}

if (!isset($_GET['recruitnum'])) {
    echo "<script>alert('잘못된 접근입니다.'); window.location.href='recruitment.php';</script>";
    exit;
}

$recruitnum = $_GET['recruitnum'];

// 세션에서 사용자 ID 가져오기
$memberid = $_SESSION['memberid'];

// 이력서 목록 조회
$resumes = [];
$stmt = $conn->prepare("SELECT resume_id, name FROM resumes WHERE memberid = ?");
$stmt->bind_param("s", $memberid);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $resumes[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>구인 글 신청</title>
    <link rel="stylesheet" href="main.css">
    <style>
        .container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #4A54E1;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #5C67F2;
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #4a54e1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>구인 글 신청</h1>
        <form action="apply.php" method="post">
            <input type="hidden" name="recruitnum" value="<?= htmlspecialchars($recruitnum); ?>">
            <label for="resume_id">이력서 선택</label>
            <select name="resume_id" id="resume_id" required>
                <?php foreach ($resumes as $resume): ?>
                    <option value="<?= htmlspecialchars($resume['resume_id']); ?>"><?= htmlspecialchars($resume['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <label for="message">하고 싶은 말</label>
            <textarea name="message" id="message" rows="5" required></textarea>
            <button type="submit">신청하기</button>
        </form>
    </div>
</body>
</html>