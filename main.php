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
        .search-container {
            text-align: center;
            padding: 20px;
            padding-bottom: 2px;
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
    </style>
</head>
<body>
    <header class="header">
        <a href="main.php"><img src="logo.png"></a>
        <ul class="menu">
            <li>
                기업 소개
                <ul>
                    <a href="hello.php"><li>인사말</li></a>
                    <a href="history.php"><li>DroneSpace 연혁</li></a>
                    <a href="vision.php"><li>아카데미 비전</li></a>
                    <a href="facility.php"><li>시설 현황</li></a>
                    <a href="map.php"><li>오시는 길</li></a>
                </ul>
            </li>
            <li>
                국가 자격증
                <ul>
                    <a href="information.php"><li>국가 자격증 안내</li></a>
                    <a href="money.php"><li>교육비 지원 안내</li></a>
                    <a href="company.php"><li>기관/단체 교육 안내</li></a>
                    <a href="type1.php"><li>1종 조종자 과정</li></a>
                    <a href="type2.php"><li>2종 조종자 과정</li></a>
                    <a href="type3.php"><li>3종 조종자 과정</li></a>
                    <a href="education.php"><li>드론 운용자 교육</li></a>
                    <a href="instructor.php"><li>지도 조종자 과정</li></a>
                    <a href="practical.php"><li>실기 평가자 과정</li></a>
                </ul>
            </li>
            <li>
                구인 & 구직
                <ul>
                    <a href="area.php"><li>지역별</li></a>
                    <a href="certificate.php"><li>자격증별</li></a>
                </ul>
            </li>
            <li>
                커뮤니티
                <ul>
                    <a href="everything.php"><li>전체글</li></a>
                    <a href="hot.php"><li>HOT글</li></a>
                    <a href="ask.php"><li>1대1 질문 게시판</li></a>
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
                    <a href="mywrite.php"><li>내가 작성한 게시글</li></a>
                    <a href="myreply.php"><li>내가 작성한 댓글</li></a>
                    <a href="application.php"><li>구인&구직 신청 현황</li></a>
                    <a href="mycer.php"><li>내 이력서</li></a>
                </ul>
            </li>
        </ul>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="키워드를 검색해보세요.">
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
                <h2>커뮤니티</h2>
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
            'konkuk.jpg',
            'konkuk2.jpg',
            'konkuk3.jpg',
            'konkuk4.jpg'
        ];

        let currentIndex = 0;

        function changeBackgroundImage() {
            const backgroundImageElement = document.querySelector('.content-background'); // 배경 이미지를 변경할 요소 선택
            backgroundImageElement.style.backgroundImage = `url('${images[currentIndex]}')`; // 현재 인덱스의 이미지로 배경 설정
            currentIndex = (currentIndex + 1) % images.length; // 다음 이미지 인덱스로 업데이트
        }

        setInterval(changeBackgroundImage, 10000); // 10초마다 changeBackgroundImage 함수 호출


        document.addEventListener('keydown', function(event) {
        if (event.metaKey && event.shiftKey && event.key === 'l') {
            event.preventDefault(); // 기본 동작 방지
            window.open('admin_login.html', '_blank'); // 새 탭에서 admin_register.html 열기
            }
        });
    </script>
</body>
</html>
