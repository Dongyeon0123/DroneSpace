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
    <link rel="stylesheet" href="main.css">
    <style>
        .content-background {
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
        .content-background video, .content-background img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .content, .search-container {
            position: relative;
            text-align: center;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            color: white;
            max-width: 80%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
            margin-top: 15px;
            margin-bottom: 35px;
        }
        .notice {
            font-size: 36px;
            font-weight: bold;
        }
        .content hr {
            width: 60px;
            height: 3px;
            background-color: #fff;
            border: none;
            margin: 20px auto;
        }
        .content span {
            display: block;
            margin-top: 20px;
            font-size: 18px;
            line-height: 1.5;
        }
        .search-container {
            text-align: center;
            padding: 20px;
            padding-bottom: 2px;
            margin-top: 20px;
        }
        #searchInput {
            padding: 18px 50px;
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
            padding: 19px 20px;
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
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px auto;
            max-width: 80%;
        }
        .grid-item {
            display: block;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            text-decoration: none;
            color: black;
        }
        .grid-item:hover {
            background-color: #f0f0f0;
        }
        .grid-item p {
            margin: 0;
            font-size: 16px;
        }
        .section {
            background-color: #fff;
            padding: 50px 150px;
            margin: 20px 0;
            text-align: center;
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
        }
        .footer a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php
        require_once "header.php";
    ?>

    <div class="content-background" id="contentBackground">
        <video autoplay muted loop id="backgroundVideo">
            <source src="konkuk.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <img src="konkuk2.jpg" id="backgroundImage" style="display:none;">

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="키워드를 검색해보세요.">
            <button id="searchButton" onclick="search()">검색</button>
            <ul id="searchResults">
                <!-- 검색 결과가 여기에 표시됩니다 -->
            </ul>
        </div>

        <div class="content">
            <span class="notice"><h2>건국대학교 드론 아카데미<br>
                Drone Space를 <b>소개합니다.</b></h2>
            </span>
            <hr>
            <span>드론과 커뮤니티가 만나는 혁신적인 구인구직 플랫폼 Drone Space에 오신 것을 환영합니다!<br>
            Drone Space는 드론 산업의 전문성을 바탕으로, 구인자와 구직자 모두에게 최적의 기회를 제공합니다.<br>
            최신 드론 기술과 관련된 다양한 직업군을 한눈에 살펴보고,
            나에게 딱 맞는 일자리를 손쉽게 찾을 수 있습니다.</span>
        </div>

        <div class="grid-container">
            <a href="hello.php" class="grid-item">
                <p>메인 페이지 소개</p>
            </a>
            <a href="information.php" class="grid-item">
                <p>국가 자격증 안내</p>
            </a>
            <a href="facility.php" class="grid-item">
                <p>시설 현황</p>
            </a>
            <a href="everything.php" class="grid-item">
                <p>커뮤니티</p>
            </a>
            <a href="map.php" class="grid-item">
                <p>오시는 길</p>
            </a>
        </div>
    </div>

    <footer class="footer">
        Wecanverse &copy; 2024. All rights reserved.
    </footer>

    <script>
        function toggleMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.toggle('show');
        }
        
        // 하위 메뉴 링크 클릭 시 메뉴 숨기기
        document.querySelectorAll('.menu-overlay-content ul li ul li a').forEach(function(link) {
            link.addEventListener('click', function() {
                var menuOverlay = document.getElementById('menuOverlay');
                menuOverlay.classList.remove('show');
            });
        });

        function closeMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.remove('show');  // 'show' 클래스를 제거하여 팝업 숨김
        }

        const images = [
            'konkuk2.jpg',
            'konkuk3.jpg',
            'konkuk4.jpg'
        ];

        let currentIndex = 0;

        function changeBackground() {
            const video = document.getElementById('backgroundVideo');
            const image = document.getElementById('backgroundImage');

            // Hide video and show image after 10 seconds
            setTimeout(() => {
                video.style.display = 'none';
                image.style.display = 'block';
            }, 10000);

            // Change image every 10 seconds
            setInterval(() => {
                image.src = images[currentIndex];
                currentIndex = (currentIndex + 1) % images.length;
            }, 10000);
        }

        document.addEventListener('DOMContentLoaded', changeBackground);

        document.addEventListener('keydown', function(event) {
        if (event.metaKey && event.shiftKey && event.key === 'l') {
            event.preventDefault(); // 기본 동작 방지
            window.open('admin_login.html', '_blank'); // 새 탭에서 admin_register.html 열기
            }
        });
    </script>
</body>
</html>
