<?php
// 세션 시작
session_start();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drone Space 비전</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 7px 35px;
            border-bottom: 2px solid #000;
        }
        .header img {
            width: 200px;
            height: 90px;
            margin-left: 100px;
            margin-top: 2.8px;
        }
        .header a {
            text-decoration: none;
        }
        .menu {
            list-style-type: none;
            padding: 0;
            display: flex;
            font-weight: bold;
            margin-top: 20px;
        }
        .menu li {
            position: relative;
            padding: 10px;
            cursor: pointer;
        }
        .menu li ul {
            position: absolute;
            top: 100%;
            left: 0;
            display: none;
            background-color: rgb(227, 227, 227);
            margin: 0px;
            list-style: none;
            padding: 0;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            border-top: 5px solid rgb(51, 179, 57);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1000; /* Ensures the submenu is above other content */
        }
        .menu li:hover ul {
            display: block;
        }
        .menu li:not(:last-child)::after {
            content: "|";
            color: rgb(156, 154, 154);
            margin-left: 30px;
            margin-right: 20px;
        }
        .menu li ul li:not(:last-child)::after {
            content: none;
        }
        .menu li ul li {
            width: 145px;
            padding: 15px;
            text-align: center;
        }
        .menu li ul li:hover {
            background-color: rgb(51, 179, 57);
            color: white;
        }
        .menu li ul li:last-child {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .menu li ul li a {
            color: black;
            text-decoration: none;
        }
        .menu li ul li a:hover {
            color: white;
        }
        .menu li:last-child a {
            color: black;
        }
        .hamburger {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            width: 35px;
            height: 30px;
            cursor: pointer;
            z-index: 1001;
        }
        .hamburger div {
            width: 100%;
            height: 3px;
            background-color: #333;
            transition: all 0.3s ease-in-out;
        }
        .hamburger:hover div:nth-child(1) {
            width: 50%;
        }
        .hamburger:hover div:nth-child(3) {
            width: 50%;
        }
        .menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(241, 55, 55, 0.8), #3b3b3b);
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease-in-out;
        }
        .menu-overlay.show {
            display: flex;
            opacity: 1;
            visibility: visible;
        }
        .menu-overlay-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            width: 80%;
        }
        .menu-overlay-content ul {
            list-style-type: none;
            padding: 0;
            font-size: 24px;
            margin: 0;
        }
        .menu-overlay-content ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .menu-overlay-content ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .vision-section {
            text-align: center;
            padding: 50px 20px;
            background-color: #fff;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .vision-section h2 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 20px;
            display: inline-block;
            border-bottom: 3px solid #333; /* 글자 색상과 일치하는 밑줄 색상 */
        }
        .vision-banner {
            background: url('path-to-your-image.png') no-repeat center center/cover;
            color: white;
            padding: 60px 20px;
            margin: 0 auto;
            max-width: 1200px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .vision-banner::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            z-index: 1;
        }
        .vision-banner p {
            font-size: 1.2em;
            line-height: 1.5em;
            margin: 0;
            font-weight: bold;
            position: relative;
            z-index: 2;
        }
        .vision-banner .main-quote {
            font-size: 1.8em; /* 폰트 크기 1.5배로 설정 */
        }
        .vision-items {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        .vision-item {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            flex: 1;
            margin: 10px;
            max-width: 250px;
            transition: transform 0.3s ease;
        }
        .vision-item:hover {
            transform: translateY(-10px);
        }
        .vision-item img {
            width: 50px;
            height: 50px;
        }
        .vision-item .sub-quote {
            font-size: 1.3em; /* 폰트 크기 1.3배로 설정 */
            color: #0779e4;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .vision-item .description {
            font-size: 1em; /* 본문 내용은 기본 폰트 크기 */
            color: #333;
            font-weight: normal;
        }
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 30px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="main.php"><img src="logo.png"></a>
        <ul class="menu">
            <li>
                기업 소개
                <ul>
                    <li><a href="hello.php">인사말</a></li>
                    <li><a href="history.php">DroneSpace 연혁</a></li>
                    <li><a href="vision.php">아카데미 비전</a></li>
                    <li><a href="facility.php">시설 현황</a></li>
                    <li><a href="map.php">오시는 길</a></li>
                </ul>
            </li>
            <li>
                국가 자격증
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
            </li>
            <li>
                구인 & 구직
                <ul>
                    <li><a href="area.php">지역별</a></li>
                    <li><a href="certificate.php">자격증별</a></li>
                </ul>
            </li>
            <li>
                드론 관련 기업
                <ul>
                    <li><a href="review.php">기업 리뷰</a></li>
                    <li><a href="interview.php">면접 후기</a></li>
                </ul>
            </li>
            <li>
                커뮤니티
                <ul>
                    <li><a href="everything.php">전체글</a></li>
                    <li><a href="hot.php">HOT글</a></li>
                    <li><a href="subject.php">주제별</a></li>
                    <li><a href="ask.php">1대1 질문 게시판</a></li>
                </ul>
            </li>
            <li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" style="color: black;">로그아웃</a>
                <?php else: ?>
                    <a href="login.html" style="color: black;">로그인 / 회원가입</a>
                <?php endif; ?>
            </li>
            <li>
                마이 페이지
                <ul>
                    <li><a href="mywrite.php">내가 작성한 게시글</a></li>
                    <li><a href="myreply.php">내가 작성한 댓글</a></li>
                    <li><a href="application.php">구인&구직 신청 현황</a></li>
                    <li><a href="mycer.php">내 자격증 현황</a></li>
                </ul>
            </li>
        </ul>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>

    <section class="vision-section">
        <h2>Drone Space 비전</h2>
        <div class="vision-banner">
            <p class="main-quote">"드론일자리 창출을 통한 사회적 가치 창출"</p>
            <br>
            <p>드론 기술의 선도자가 되어, 우리는 지속 가능한 미래와 기술 혁신을 위해 정보의 집합체를 만든다.<br>전문 지식과 드론시장의 동향을 파악하여 드론 산업의 다양한 연구를 충족시킬 수 있도록 지원하며, 실질적인 기회를 제공합니다.</p>
        </div>
        <div class="vision-items">
            <div class="vision-item">
                <img src="icon1.png" >
                <p class="sub-quote">정보제공을 통한 혁신</p>
                <p class="description">보다 더 전문적인 정보를 제공하여 기술적 진입장벽을 낮추겠습니다.</p>
            </div>
            <div class="vision-item">
                <img src="icon2.png" >
                <p class="sub-quote">구인구직 중개시스템 구축</p>
                <p class="description">구인자는 사이트를 통해 검증된 <br>구직자를 구할 수 있습니다.</p>
            </div>
            <div class="vision-item">
                <img src="icon3.png" >
                <p class="sub-quote">상호평가 시스템</p>
                <p class="description">사이트 이용자간 평가를 통해 <br>개인 신뢰도 반영합니다.</p>
            </div>
            <div class="vision-item">
                <img src="icon4.png" >
                <p class="sub-quote">무한한 성장가능성</p>
                <p class="description">최신기술의 트랜드 파악과 학습을 통해 앞으로의 변화를 예측하여 <br>선도하겠습니다.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Drone Space</p>
    </footer>
    <div class="menu-overlay" id="menuOverlay">
        <div class="menu-overlay-content">
            <ul>
            <li>
                기업 소개
                <ul>
                    <li><a href="hello.php">인사말</a></li>
                    <li><a href="history.php">DroneSpace 연혁</a></li>
                    <li><a href="vision.php">아카데미 비전</a></li>
                    <li><a href="facility.php">시설 현황</a></li>
                    <li><a href="map.php">오시는 길</a></li>
                </ul>
            </li>
            <li>
                국가 자격증
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
            </li>
            <li>
                구인 & 구직
                <ul>
                    <li><a href="area.php">지역별</a></li>
                    <li><a href="certificate.php">자격증별</a></li>
                </ul>
            </li>
            <li>
                드론 관련 기업
                <ul>
                    <li><a href="review.php">기업 리뷰</a></li>
                    <li><a href="interview.php">면접 후기</a></li>
                </ul>
            </li>
            <li>
                커뮤니티
                <ul>
                    <li><a href="everything.php">전체글</a></li>
                    <li><a href="hot.php">HOT글</a></li>
                    <li><a href="subject.php">주제별</a></li>
                    <li><a href="ask.php">1대1 질문 게시판</a></li>
                </ul>
            </li>
            <li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" style="color: black;">로그아웃</a>
                <?php else: ?>
                    <a href="login.html" style="color: black;">로그인 / 회원가입</a>
                <?php endif; ?>
            </li>
            <li>
                마이 페이지
                <ul>
                    <li><a href="mywrite.php">내가 작성한 게시글</a></li>
                    <li><a href="myreply.php">내가 작성한 댓글</a></li>
                    <li><a href="application.php">구인&구직 신청 현황</a></li>
                    <li><a href="mycer.php">내 자격증 현황</a></li>
                </ul>
            </li>
            </ul>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.toggle('show');
        }
    </script>
</body>
</html>