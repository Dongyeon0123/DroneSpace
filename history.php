<?php
// 세션 시작
session_start();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>연혁</title>
    <style>
        @charset "utf-8";
        .container {
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
        }
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
        .main {
            padding: 50px;
            background: #fff;
            font-size: 17px;
            font-weight: bold;
        }
        .main h1 {
            margin-top: 0;
            text-align: center;
            font-size: 2.5em;
            color: #333;
        }
        .timeline {
            position: relative;
            padding: 20px 0;
            list-style: none;
        }
        .timeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #0077C3;
            left: 50%;
            margin-left: -2px;
        }
        .timeline-item {
            margin: 20px 0;
            padding: 20px;
            position: relative;
            width: 45%;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            transition: transform 0.3s;
        }
        .timeline-item:hover {
            transform: translateY(-10px);
        }
        .timeline-item:before {
            content: '';
            position: absolute;
            top: 20px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #0077C3;
            border: 4px solid #fff;
            z-index: 1;
        }
        .timeline-item.left {
            left: 20px;
        }
        .timeline-item.left:before {
            right: -30px;
        }
        .timeline-item.right {
            left: 51%;
        }
        .timeline-item.right:before {
            left: -31px;
        }
        .timeline-content .date {
            font-weight: bold;
            font-size: 20px;
            color: #0077C3;
            margin-bottom: 10px;
        }
        .timeline-content p {
            margin: 0;
            font-size: 1.2em;
        }
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 30px;
            margin-top: 30px;
        }

        @media (max-width: 1200px) {
            .timeline-item {
                width: 70%;
                left: 15%;
            }
            .timeline-item.right {
                left: 15%;
            }
        }
        @media (max-width: 800px) {
            .timeline-item {
                width: 90%;
                left: 5%;
            }
            .timeline-item.right {
                left: 5%;
            }
        }
        @media (max-width: 640px) {
            .timeline:before {
                left: 0;
            }
            .timeline-item {
                width: 100%;
                left: 0;
                padding: 10px;
            }
            .timeline-item.right {
                left: 0;
            }
            .timeline-item:before {
                left: 10px;
                right: auto;
            }
            .main h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
<header class="header">
        <a href="main.php"><img src="logo.png"></a>
        <ul class="menu">
        <li>
        <span class="menuli">기업 소개</span>
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

    <section class="main container">
        <h1>연혁</h1>
        <ul class="timeline">
            <li class="timeline-item left">
                <div class="timeline-content">
                    <p class="date">23년 9월 1일</p>
                    <p>KU 건국드론단 창설 (60명)</p>
                </div>
            </li>
            <li class="timeline-item right">
                <div class="timeline-content">
                    <p class="date">23년 11월 24일</p>
                    <p>CELEB 연구원 드론 서포터즈 1기</p>
                </div>
            </li>
            <li class="timeline-item left">
                <div class="timeline-content">
                    <p class="date">24년 2월 24일</p>
                    <p>KU 건국드론단 2기 모집 (61명)</p>
                </div>
            </li>
            <li class="timeline-item right">
                <div class="timeline-content">
                    <p class="date">24년 2월 25일</p>
                    <p>협의체 발대식</p>
                </div>
            </li>
            <li class="timeline-item left">
                <div class="timeline-content">
                    <p class="date">24년 3월 7일</p>
                    <p>중앙동아리 창설 KU 건국드론단 ㅡ> 콤비 명칭 변경</p>
                </div>
            </li>
            <li class="timeline-item right">
                <div class="timeline-content">
                    <p class="date">24년 3월 31일</p>
                    <p>창업동아리 날리자KU 창설</p>
                </div>
            </li>
            <li class="timeline-item left">
                <div class="timeline-content">
                    <p class="date">24년 5월 1일</p>
                    <p>Drone Space 설립</p>
                </div>
            </li>
        </ul>
    </section>

    <footer>
        <p>Copyright &copy; 2024 Drone Space</p>
    </footer>
    <div class="menu-overlay" id="menuOverlay">
        <div class="image-container">
            <a href="main.php"><img src="logo.png"></a>
        </div>
        <div class="menu-overlay-content">
            <span class="close-btn" onclick="closeMenu()">X</span>
            <div>
            <h2 style="color: red;">기업 소개</h2>
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
    <script>
        function toggleMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.toggle('show');
        }
        function closeMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.remove('show');  // 'show' 클래스를 제거하여 팝업 숨김
        }
    </script>
</body>
</html>
