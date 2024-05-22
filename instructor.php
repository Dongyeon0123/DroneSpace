<?php
// 세션 시작
session_start();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>지도조종자 과정</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
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
        .menuli {
            color: red;
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
            width: 175px;  /* 너비 조정이 필요하면 수정 */
            background-color: rgb(227, 227, 227);
            list-style: none;
            padding: 0;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            border-top: 5px solid rgb(51, 179, 57);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            visibility: hidden;
            opacity: 0;
            overflow: hidden;
            transition: all 0.5s ease-in-out; /* 효과 지속시간과 타이밍 함수 조정 */
            z-index: 1000;
        }
        .menu li:hover ul {
            visibility: visible;
            opacity: 1;
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

        .menu a li {
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
            background: linear-gradient(to right, rgba(1, 161, 91, 0.9), #3b3b3b);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease-in-out;
            z-index: 1002;
        }

        .close-btn {
            position: absolute;
            top: 40px;
            right: 40px;
            cursor: pointer;
            font-size: 24px;
            color: white;
            z-index: 101;  /* 메뉴 위에 보이도록 z-index 설정 */
        }


        .menu-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .menu-overlay-content {
            text-align: center;
            color: white;
            width: 80%;
            margin-top: 5%; /* 팝업 상단에서 조금 내려오도록 위치 조정 */
        }

        .menu-overlay-content ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .menu-overlay-content ul li {
            font-size: 24px; /* 상위 메뉴 글자 크기 */
            margin-bottom: 5px;
            padding: 10px;
            background-color: rgba(0,0,0,0.5);
            border-radius: 5px;
        }

        .menu-overlay-content ul li a {
            color: white;
            text-decoration: none;
        }

        .menu-overlay-content ul li ul {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 5px;
            padding: 0;
        }

        .menu-overlay-content ul li ul li {
            font-size: 18px; /* 하위 메뉴 글자 크기 */
            padding: 5px 10px;
            background: none; /* 배경색 제거 */
            margin: 2px;
            border-radius: 5px;
        }

        .menu-overlay-content ul li ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 5px;
            border-radius: 5px;
        }
        .showcase {
            background: #333 url('drone.jpg') no-repeat 0 -400px;
            text-align: center;
            color: #fff;
        }
        .showcase h1 {
            margin-top: 50px;
            font-size: 55px;
            margin-bottom: 10px;
        }
        .showcase p {
            font-size: 20px;
            margin-bottom: 50px;
        }
        .main-content {
            padding: 20px;
            background: #fff;
        }
        .main-content h2 {
            margin-top: 0;
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
        .footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
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
            <span class="menuli">국가 자격증</span>
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
                드론 관련 기업
                <ul>
                    <a href="review.php"><li>기업 리뷰</li></a>
                    <a href="interview.php"><li>면접 후기</li></a>
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
                    <a href="mycer.php"><li>내 자격증 현황</li></a>
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
            <h1>지도 조종자 과정</h1>
            <p>드론 지도자 교육 과정 안내</p>
        </div>
    </section>

    <section class="main-content container">
        <h2>과정소개</h2>
        <p>지도조종자(교관) 과정은 초경량 비행장치의 전문가를 꿈꾸는 분들을 위한 심화 교육 프로그램입니다. 이 과정을 통해 참가자는 드론 교육의 선봉장으로서의 역할을 준비하며, 드론 산업 내에서 리더로 거듭날 수 있는 기회를 갖게 됩니다.</p>
        
        <h2>교육 특징</h2>
        <ul>
            <li>실제 비행 경험에 기반한 심화 교육: 80시간 이상의 조종 교육을 통해, 실제 비행에 필요한 조종 기술 및 교수법을 집중적으로 습득합니다.</li>
            <li>교육생 지도교육: 부교관 역할을 수행하며 실제 교육 현장에서의 지도 능력을 강화합니다.</li>
            <li>체계적인 실기 비행 경험: 80시간의 실기 비행을 통해 조종 능력을 체계적으로 쌓아갑니다.</li>
        </ul>
        
        <h2>자격 요건 및 취득 방법</h2>
        <ul>
            <li>나이: 만 18세 이상</li>
            <li>비행 경력: 총 100시간 (초경량비행장치조종자 자격증 1종 포함)</li>
            <li>필기 시험: 25문항 중 70점 이상 획득 (향후 실기 예정)</li>
        </ul>
        
        <h2>활용 가능 분야</h2>
        <ul>
            <li>교육기관: 지도조종자 자격증을 취득하면 드론 교육 기관에서 교관으로 활동할 수 있습니다.</li>
            <li>실기평가: 실기평가조종자 자격증을 통한 전문 교육기관 운영</li>
            <li>산업응용: 인프라 점검, 항공촬영 등 다양한 산업 분야에서 활용</li>
        </ul>
        
        <h2>교육 커리큘럼 개요</h2>
        <h3>지도조종자(교관) 과정 세부 커리큘럼</h3>
        <table>
            <tr>
                <th>주차</th>
                <th>주제</th>
                <th>내용</th>
                <th>시간</th>
            </tr>
            <tr>
                <td>1~2주차</td>
                <td>기본 비행 기술 학습</td>
                <td>
                    - 이륙과 호버링 마스터클래스: 수직 이륙 및 정지 비행의 정밀도 향상, 호버링 시 위치 및 고도 유지 능력 강화<br>
                    - 측면 및 삼각비행 기술: 측면비행 연습, 삼각비행을 통한 다양한 각도에서의 조종법 숙달<br>
                    - 비상착륙 및 정상 접근 착륙: 비상 상황 시 착륙 절차 연습, 정상 접근을 통한 착륙 기술 습득
                </td>
                <td>20시간</td>
            </tr>
            <tr>
                <td>3~7주차</td>
                <td>고급 비행 기술 및 응용</td>
                <td>
                    - ATTI 모드에서의 고급 비행 연습: GPS 없이 드론 조종 기술 학습<br>
                    - 비행 경로 계획과 실행의 정확성 향상<br>
                    - 다양한 환경에서의 비행 실습: 측풍 및 변덕스러운 기상 조건 대응, 주변 환경 인식 및 장애물 회피 기술 숙달
                </td>
                <td>50시간</td>
            </tr>
            <tr>
                <td>8주차</td>
                <td>실무 적용 및 비행 경력증명</td>
                <td>
                    - 비행 경력증명서 작성 및 기체 세팅: 실무 비행 경력 기록 방법, 드론 기체 설정 및 유지 보수 교육<br>
                    - 실기시험 준비 및 항공촬영 기술: 실기시험 접수 및 준비 방법, 항공 촬영 기법 및 사진/영상 처리 기초
                </td>
                <td>10시간</td>
            </tr>
            <tr>
                <td colspan="3">총 교육시간</td>
                <td>80시간</td>
            </tr>
        </table>
        
        <h2>교육 신청 및 문의</h2>
        <p>지도조종자(교관) 과정에 대한 자세한 정보 및 신청 절차는 <a href="#">교육 신청 페이지</a>에서 확인하실 수 있습니다. 본 과정은 드론 조종의 전문성을 키우고자 하는 분들에게 필요한 모든 정보를 제공하기 위해 마련되었습니다. 드론 산업에서의 리더십을 발휘하고자 하는 분들의 많은 참여를 기다립니다.</p>
    </section>

    <div class="menu-overlay" id="menuOverlay">
        <div class="menu-overlay-content">
        <span class="close-btn" onclick="closeMenu()">X</span>
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
                    <li><a href="ask.php">1대1 질문 게시판</a></li>
                </ul>
            </li>
            <li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" style="color: white;">로그아웃</a>
                <?php else: ?>
                    <a href="login.html" style="color: white;">로그인 / 회원가입</a>
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
        function closeMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.remove('show');  // 'show' 클래스를 제거하여 팝업 숨김
        }
    </script>
</body>
</html>