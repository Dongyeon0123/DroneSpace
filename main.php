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
            transition: opacity 1s ease-in-out; /* 페이드 인/아웃 효과를 위한 트랜지션 */
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
            margin-bottom: 20px;
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
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.3s ease-in-out;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
        }

        .search-result {
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        .search-result:hover {
            background-color: #f0f0f0;
        }

        .search-result h3 {
            margin: 0;
            font-size: 18px;
        }

        .search-result p {
            margin: 5px 0 0;
            color: #555;
        }

        /* 애니메이션 효과 */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
            }
            to {
                transform: translateY(0);
            }
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
            <button id="searchButton">검색</button>
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
                <p>사이트 소개</p>
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

    <footer>
        <p>Copyright &copy; 2024 Drone Space</p>
    </footer>
    
    <div id="searchModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>검색 결과</h2>
            <div id="searchResults"></div>
        </div>
    </div>

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
            'konkuk1.jpeg',
            'konkuk2.jpeg',
            'konkuk3.jpeg'
        ];

        let currentIndex = 0;

        function changeBackground() {
            const video = document.getElementById('backgroundVideo');
            const image = document.getElementById('backgroundImage');

            // Hide video and show image after 10 seconds
            setTimeout(() => {
                video.style.opacity = '0';
                setTimeout(() => {
                    video.style.display = 'none';
                    image.style.display = 'block';
                    image.style.opacity = '1';
                }, 1000); // Allow time for fade out
            }, 10000);

            // Change image every 10 seconds
            setInterval(() => {
                image.style.opacity = '0';
                setTimeout(() => {
                    image.src = images[currentIndex];
                    image.style.opacity = '1';
                    currentIndex = (currentIndex + 1) % images.length;
                }, 1000); // Allow time for fade out
            }, 10000);
        }

        document.addEventListener('DOMContentLoaded', changeBackground);

        document.addEventListener('keydown', function(event) {
        if (event.metaKey && event.shiftKey && event.key === 'l') {
            event.preventDefault(); // 기본 동작 방지
            window.open('admin_login.html', '_blank'); // 새 탭에서 admin_register.html 열기
            }
        });
        
        window.addEventListener('scroll', function() {
            const scrollheader = document.getElementById('scrollheader');
            const mainHeader = document.getElementById('mainHeader');
            if (window.scrollY > 150) {
                mainHeader.style.top = '-130px';
                scrollheader.style.top = '0px';
            } else {
                mainHeader.style.top = '0px';
                scrollheader.style.top = '-130px';
            }
        });

        function toggleMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.toggle('show');
        }

        function closeMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.remove('show');
        }
        
        document.getElementById('searchButton').addEventListener('click', function() {
            const keyword = document.getElementById('searchInput').value;
            if (!keyword) return;

            fetch(`search.php?keyword=${keyword}`)
                .then(response => response.json())
                .then(data => {
                    const searchResults = document.getElementById('searchResults');
                    searchResults.innerHTML = '';

                    if (data.error) {
                        searchResults.innerHTML = `<p>${data.error}</p>`;
                    } else if (data.posts.length === 0) {
                        searchResults.innerHTML = '<p>검색 결과가 없습니다.</p>';
                    } else {
                        data.posts.forEach(post => {
                            const postElement = document.createElement('div');
                            postElement.classList.add('search-result');
                            postElement.innerHTML = `<a href="${post.url}" style="text-decoration: none; color: inherit;"> 
                                <h3>${post.posttitle}</h3>
                                <p>${post.postcontent}</p>
                            </a>
                            `;
                            searchResults.appendChild(postElement);
                        });
                    }

                    openModal();
                });
        });

        function openModal() {
            document.getElementById('searchModal').style.display = "flex";
        }

        function closeModal() {
            document.getElementById('searchModal').style.display = "none";
        }
    </script>
</body>
</html>
