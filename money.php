<?php
// 세션 시작
session_start();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>교육비 지원</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding-bottom: 70px;
        }
        .main-content {
            padding: 20px;
            background: #fff;
            margin-top: 20px;
        }
        .main-content h2, .main-content h3 {
            color: #333;
        }
        .main-content p, .main-content ul {
            margin-bottom: 20px;
        }
        .main-content ul {
            list-style: none;
            padding: 0;
        }
        .main-content ul li {
            background: #eee;
            margin: 5px 0;
            padding: 10px;
        }
        .main-content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .main-content table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .main-content th {
            background-color: #f2f2f2;
            text-align: left;
        }
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        .header-icons span {
            margin-right: 10px;
        }
        .menu-icons {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }
        .menu-icons div {
            flex: 1;
            text-align: center;
            padding: 10px;
            background: #ddd;
            margin: 5px;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding-bottom: 70px;
        }
        .showcase {
            background: #333 url('drone.jpg') no-repeat 0 -400px;
            text-align: center;
            color: #fff;
        }
        .showcase h1 {
            margin-top: 70px;
            font-size: 55px;
            margin-bottom: 10px;
        }
        .showcase p {
            font-size: 15px;
            margin-bottom: 30px;
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
            <li>
                마이 페이지
                <ul>
                    <li><a href="#">내가 작성한 게시글</a></li>
                    <li><a href="#">내가 작성한 댓글</a></li>
                    <li><a href="#">구인&구직 신청 현황</a></li>
                    <li><a href="#">내 자격증 현황</a></li>
                </ul>
            </li>
        </ul>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>
    <section class="showcase">
        <div class="container">
            <h1>교육비지원</h1>
        </div>
    </section>

        <section class="main-content container">
            <h2>교육비지원안내</h2>
            <p>국민내일배움카드 교육비 지원 안내</p>
            <p>국민내일배움카드를 통한 교육비 지원은 국민 누구나 질 높은 직업 교육을 받을 수 있도록 고용노동부에서 마련한 제도입니다. 현재 시스템은 준비 중에 있으며, 다음과 같은 내용으로 구성됩니다.</p>

            <h3>교육비 지원 안내</h3>
            <table>
                <tr>
                    <th>항목</th>
                    <th>내용</th>
                </tr>
                <tr>
                    <td>소관기관</td>
                    <td>고용노동부</td>
                </tr>
                <tr>
                    <td>신청방법</td>
                    <td>가까운 고용센터 또는 HRD-Net을 통해 신청</td>
                </tr>
                <tr>
                    <td>지원내용</td>
                    <td>5년간 300~500만원 한도 내에서 인정받은 적합훈련과정 수강 시 훈련비의 일부 또는 전액 지원</td>
                </tr>
                <tr>
                    <td>지원대상</td>
                    <td>국민 누구나</td>
                </tr>
                <tr>
                    <td>지원 제외 대상</td>
                    <td>공무원, 사립학교 교직원, 특정 소득 이상 자영업자, 대규모기업 근로자 등</td>
                </tr>
                <tr>
                    <td>선정기준</td>
                    <td>직업경력, 직업 능력 수준 등을 고려한 훈련 필요성 평가</td>
                </tr>
                <tr>
                    <td>신청절차</td>
                    <td>구직등록 → 카드발급 신청 → 훈련상담 및 수강신청 → 훈련수강</td>
                </tr>
            </table>
        </section>
    </div>
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
                <li><a href="login.html" style="color: black;">로그인 / 회원가입</a></li>
                <li>
                마이 페이지
                <ul>
                    <li><a href="#">내가 작성한 게시글</a></li>
                    <li><a href="#">내가 작성한 댓글</a></li>
                    <li><a href="#">구인&구직 신청 현황</a></li>
                    <li><a href="#">내 자격증 현황</a></li>
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