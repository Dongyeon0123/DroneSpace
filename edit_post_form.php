<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postnum = $_POST['postnum'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE post SET posttitle = ?, postcontent = ? WHERE postnum = ? AND memberid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $title, $content, $postnum, $_SESSION['memberid']);

    if ($stmt->execute()) {
        echo "<script>alert('게시글이 수정되었습니다.'); window.location.href='everything.php';</script>";
    } else {
        echo "<script>alert('게시글 수정에 실패했습니다.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['postnum'])) {
    $postnum = $_GET['postnum'];

    $sql = "SELECT posttitle, postcontent FROM post WHERE postnum = ? AND memberid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $postnum, $_SESSION['memberid']);
    $stmt->execute();
    $stmt->bind_result($title, $content);
    $stmt->fetch();

    if (!$title || !$content) {
        echo "<script>alert('게시글을 찾을 수 없습니다.'); window.location.href='everything.php';</script>";
        exit;
    }

    $stmt->close();
} else {
    echo "<script>alert('잘못된 요청입니다.'); window.location.href='everything.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 수정</title>
    <link rel="stylesheet" href="main.css">
    <style>
        .container {
            font-family: 'Nunito', sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        form {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            width: 400px;
            max-width: 90%;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 16px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 2px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        textarea:focus {
            border-color: #0056b3;
        }
        textarea {
            height: 150px;
            resize: none;
        }
        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        button:hover {
            background-color: #004494;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="main.php"><img src="logo.png"></a>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>

    <h1>게시글 수정</h1>
    <div class="container">
        <form method="post" action="edit_post_form.php">
            <input type="hidden" name="postnum" value="<?= htmlspecialchars($postnum); ?>">
            <label for="title">제목:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($title); ?>" required>
            <label for="content">내용:</label>
            <textarea id="content" name="content" required><?= htmlspecialchars($content); ?></textarea>
            <button type="submit">수정</button>
        </form>
    </div>
    
    <div class="menu-overlay" id="menuOverlay">
        <div class="image-container">
            <a href="main.php"><img src="logo.png"></a>
        </div>
        <div class="menu-overlay-content">
            <span class="close-btn" onclick="closeMenu()">X</span>
            <div>
                <h2>기업 소개</h2>
                    <ul>
                        <li><a href="hello.php">인사말</a></li>
                        <li><a href="history.php">DroneSpace 연혁</a></li>
                        <li><a href="vision.php">아카데미 비전</a></li>
                        <li><a href="facility.php">시설 현황</a></li>
                        <li><a href="map.php">오시는 길</a></li>
                    </ul>
            </div>
            <div>
                <h2>국가 자격증</h2>
                    <ul>
                        <li><a href="information.php">국가 자격증 안내</a></li>
                        <li><a href="money.php">교육비 지원 안내</a></li>
                        <li><a href="company.php">기관/단체 교육 안내</a></li>
                        <li><a href="type1.php">1종 조종자 과정</a></li>
                        <li><a href="type2.php">2종 조종자 과정</a></li>
                        <li><a href="type3.php">3종 조종자 과정</a></li>
                        <li><a href="education.php">드론 운용자 교육</a></li>
                        <li><a href="instructor.php">지도 조종자 과정</a></li>
                        <li><a href="practical.php">실기 평가자 과정</a></li>
                    </ul>
            </div>
            <div>
                <h2>구인 & 구직</h2>
                    <ul>
                        <li><a href="area.php">지역별</a></li>
                        <li><a href="certificate.php">자격증별</a></li>
                    </ul>
            </div>
            <div>
                <h2 style="color: red;">커뮤니티</h2>
                    <ul>
                        <li><a href="everything.php">전체글</a></li>
                        <li><a href="hot.php">HOT글</a></li>
                        <li><a href="ask.php">1대1 질문 게시판</a></li>
                    </ul>
            </div>
            <div style="margin-top: 24px;">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" style="color: white; font-size: 24px;">로그아웃</a>
                <?php else: ?>
                    <a href="login.html" style="color: white; font-size: 24px;">로그인 / 회원가입</a>
                <?php endif; ?>
            </div>
            <div>
                <h2>마이 페이지</h2>
                    <ul>
                        <li><a href="mywrite.php">내가 작성한 게시글</a></li>
                        <li><a href="myreply.php">내가 작성한 댓글</a></li>
                        <li><a href="application.php">구인&구직 신청 현황</a></li>
                        <li><a href="mycer.php">내 이력서</a></li>
                    </ul>
            </div>
        </div>
    </div>
</body>
</html>
