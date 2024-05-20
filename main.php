<?php
// 세션 시작
session_start();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>드론 스페이스</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 35px;
            border-bottom: 2px solid #000;
        }
        .header img {
            width: 200px;
            height: 90px;
            margin: 0;
            margin-left: 100px;
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
        .search-container {
            background-color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }
        #searchInput {
            padding: 13px 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 50%;
        }
        #searchInput:focus {
            outline: none;
            border-color: blue;
        }
        #searchButton {
            padding: 13px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
        }
        #searchButton:hover {
            background-color: #0056b3;
        }
        .content-background {
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            transition: background-image 1s ease-in-out;
        }
        .content {
            text-align: left;
            margin: 70px 150px;
            padding: 50px;
            border-radius: 10px;
            color: white;
        }
        .notice {
            font-size: 32px;
        }
        .content hr {
            width: 50px;
            height: 3px;
            background-color: #fff;
            border: none;
            margin: 20px 0;
        }
        .content span {
            display: block;
            margin-top: 20px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 150px;
        }
        .grid-item {
            display: flex;
            align-items: center;
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .grid-item img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-right: 20px;
        }
        .grid-item p {
            margin: 0;
        }
        .section {
            background-color: #fff;
            padding: 50px 150px;
            margin: 20px 0;
        }
        .section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        .section p {
            font-size: 18px;
            line-height: 1.6;
        }
        .section img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 20px;
        }
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }
        .footer a {
            color: white;
            text-decoration: none;
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
                    <li><a href="#">DroneSpace 연혁</a></li>
                    <li><a href="#">아카데미 비전</a></li>
                    <li><a href="#">인증서</a></li>
                    <li><a href="#">시설 현황</a></li>
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
                    <li><a href="#">자격증별</a></li>
                </ul>
            </li>
            <li>
                드론 관련 기업
                <ul>
                    <li><a href="review.php">기업 리뷰</a></li>
                    <li><a href="#">면접 후기</a></li>
                </ul>
            </li>
            <li>
                커뮤니티
                <ul>
                    <li><a href="everything.php">전체글</a></li>
                    <li><a href="#">HOT글</a></li>
                    <li><a href="#">주제별</a></li>
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
        </ul>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="채용정보를 검색해보세요.">
        <button id="searchButton" onclick="search()">검색</button>
        <ul id="searchResults">
            <!-- 검색 결과가 여기에 표시됩니다 -->
        </ul>
    </div>

    <div class="content-background">
        <div class="content">
            <span class="notice">건국대학교 드론 아카데미<br>
                Drone Space를 <b>소개합니다.</b>
            </span>
            <hr>
            <span>건국대학교 Drone Space는 <br>
            대충 소개하는 글</span>
        </div>

        <div class="grid-container">
            <div class="grid-item">
                <img src="https://placehold.co/100x100" alt="공지사항 이미지 1">
                <p>공지사항 1</p>
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/100x100" alt="공지사항 이미지 2">
                <p>공지사항 2</p>
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/100x100" alt="공지사항 이미지 3">
                <p>공지사항 3</p>
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/100x100" alt="공지사항 이미지 4">
                <p>공지사항 4</p>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Our Services</h2>
        <div class="grid-container">
            <div class="grid-item">
                <img src="https://placehold.co/400x300" alt="UX/UI Designer">
                <p>UX/UI Designer</p>
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/400x300" alt="Interaction Designer">
                <p>Interaction Designer</p>
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/400x300" alt="Motion Graphic Designer">
                <p>Motion Graphic Designer</p>
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/400x300" alt="3D Designer">
                <p>3D Designer</p>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Recent Projects</h2>
        <div class="grid-container">
            <div class="grid-item">
                <img src="https://placehold.co/400x300" alt="Project 1">
                <p>Project 1</p>
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/400x300" alt="Project 2">
                <p>Project 2</p>
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/400x300" alt="Project 3">
                <p>Project 3</p>
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/400x300" alt="Project 4">
                <p>Project 4</p>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Clients</h2>
        <div class="grid-container">
            <div class="grid-item">
                <img src="https://placehold.co/200x100" alt="Client 1">
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/200x100" alt="Client 2">
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/200x100" alt="Client 3">
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/200x100" alt="Client 4">
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/200x100" alt="Client 5">
            </div>
            <div class="grid-item">
                <img src="https://placehold.co/200x100" alt="Client 6">
            </div>
        </div>
    </div>

    <div class="section" style="background-color: #333; color: white;">
        <h2>Contact Us</h2>
        <p>여러분의 프로젝트에 대해 자세히 이야기해보고 싶습니다. 언제든지 연락주세요.</p>
    </div>

    <footer class="footer">
        Wecanverse &copy; 2024. All rights reserved.
    </footer>

    <div class="menu-overlay" id="menuOverlay">
        <div class="menu-overlay-content">
            <ul>
                <li>기업 소개
                    <ul>
                        <li><a href="hello.html">인사말</a></li>
                        <li><a href="#">DroneSpace 연혁</a></li>
                        <li><a href="#">아카데미 비전</a></li>
                        <li><a href="#">인증서</a></li>
                        <li><a href="#">시설 현황</a></li>
                        <li><a href="#">오시는 길</a></li>
                        <li><a href="#">전체 교육 과정 안내</a></li>
                    </ul>
                </li>
                <li>국가 자격증
                    <ul>
                        <li><a href="nformation.html">국가 자격증 안내</a></li>
                        <li><a href="#">교육비 지원 안내</a></li>
                        <li><a href="#">기관/단체 교육 안내</a></li>
                        <li><a href="type1.html">1종 조종자 과정</a></li>
                        <li><a href="type2.html">2종 조종자 과정</a></li>
                        <li><a href="type3.html">3종 조종자 과정</a></li>
                        <li><a href="#">드론 운용자 교육</a></li>
                        <li><a href="#">지도 조종자 과정</a></li>
                        <li><a href="#">실기 평가자 과정</a></li>
                    </ul>
                </li>
                <li>구인 & 구직
                    <ul>
                        <li><a href="area.html">지역별</a></li>
                        <li><a href="#">자격증별</a></li>
                    </ul>
                </li>
                <li>드론 관련 기업
                    <ul>
                        <li><a href="review.html">기업 리뷰</a></li>
                        <li><a href="#">면접 후기</a></li>
                    </ul>
                </li>
                <li>커뮤니티
                    <ul>
                        <li><a href="everything.html">전체글</a></li>
                        <li><a href="#">HOT글</a></li>
                        <li><a href="#">주제별</a></li>
                        <li><a href="#">1대1 질문 게시판</a></li>
                    </ul>
                </li>
                <li>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                        <a href="logout.php" style="color: black;">로그아웃</a>
                    <?php else: ?>
                        <a href="login.html" style="color: black;">로그인 / 회원가입</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.toggle('show');
        }

        const images = [
            'konkuk.jpg',
            'konkuk2.jpg',
            'konkuk3.jpg',
            'konkuk4.jpg'
        ];

        let currentIndex = 0;

        function changeBackgroundImage() {
            const contentBackground = document.querySelector('.content-background');
            contentBackground.style.backgroundImage = `url(${images[currentIndex]})`;
            currentIndex = (currentIndex + 1) % images.length;
        }

        setInterval(changeBackgroundImage, 10000);

        // Initialize the first image
        changeBackgroundImage();
    </script>
</body>
</html>
