<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $memberid = $_SESSION['memberid'];

    $stmt = $conn->prepare("INSERT INTO recruitment (memberid, title, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $memberid, $title, $description);

    if ($stmt->execute()) {
        echo "<script>alert('구인글이 성공적으로 작성되었습니다.'); window.location.href='recruitment.php';</script>";
    } else {
        echo "<script>alert('구인글 작성에 실패했습니다.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>구인글 작성</title>
    <link rel="stylesheet" href="main.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], textarea {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #5C67F2;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #4a54e1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>구인글 작성</h1>
        <form method="POST" action="recruit_form.php">
            <input type="text" name="title" placeholder="제목" required>
            <textarea name="description" placeholder="설명" required></textarea>
            <button type="submit">작성</button>
        </form>
    </div>
</body>
</html>
