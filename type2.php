<?php
// 세션 시작
session_start();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2종 과정</title>
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
    </style>
</head>
<body>
    <header class="header">
        <a href="main.php"><img src="logo.png"></a>
        <ul class="menu">
            <li>
                기업 소개
                <ul>
                    <li><a href="hello.html">인사말</a></li>
                    <li><a href="#">DroneSpace 연혁</a></li>
                    <li><a href="#">아카데미 비전</a></li>
                    <li><a href="#">인증서</a></li>
                    <li><a href="#">시설 현황</a></li>
                    <li><a href="map.html">오시는 길</a></li>
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
                    <li><a href="area.html">지역별</a></li>
                    <li><a href="#">자격증별</a></li>
                </ul>
            </li>
            <li>
                드론 관련 기업
                <ul>
                    <li><a href="review.html">기업 리뷰</a></li>
                    <li><a href="#">면접 후기</a></li>
                </ul>
            </li>
            <li>
                커뮤니티
                <ul>
                    <li><a href="everything.html">전체글</a></li>
                    <li><a href="#">HOT글</a></li>
                    <li><a href="#">주제별</a></li>
                    <li><a href="ask.html">1대1 질문 게시판</a></li>
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
    <section class="showcase">
        <div class="container">
            <h1>드론 국가자격증 2종 과정</h1>
            <p>드론 조종 및 운용에 대한 깊이 있는 이해와 전문적인 기술 습득을 목표로 합니다.</p>
        </div>
    </section>

    <section class="main-content container">
        <h2>취득 시 운용 가능 기체</h2>
        <p>7kg 이상 ~ 25kg 미만</p>
        
        <h2>취득 시 활용 분야</h2>
        <ul>
            <li>소형 드론 방제 (농약, 비료, 약제 살포 등)</li>
            <li>대학 진학</li>
            <li>군 특기병 지원</li>
            <li>관공서 및 공공기관</li>
            <li>기업</li>
            <li>항공촬영</li>
            <li>측량 등 다양한 업무</li>
        </ul>
        
        <h2>전문 교육과정 안내</h2>
        <p>드론 조종 및 운용에 대한 깊이 있는 이해와 전문적인 기술 습득을 목표로 합니다.</p>
        
        <h3>장점</h3>
        <ul>
            <li>체계적이고 깊이 있는 교육 커리큘럼으로 전문 지식 습득</li>
            <li>실제 비행 실습을 통한 실전 경험 제공</li>
            <li>다양한 드론 운용 시나리오에 대한 이해 증진</li>
            <li>드론 기술의 최신 트렌드와 안전 규정 학습</li>
        </ul>
        
        <h3>단점</h3>
        <ul>
            <li>상대적으로 긴 교육 기간 요구</li>
            <li>속성 과정에 비해 높은 교육 비용 발생 가능성</li>
            <li>일정한 시간 투자가 필요하여 바쁜 일정의 학습자에게 부담</li>
            <li>학과시험에 대한 부담이 적어 자칫 이론 수업 부진이 올 수 있음</li>
        </ul>
        
        <h3>전문 교육 과정 상세 내용</h3>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>과정</th>
                <th>시간</th>
                <th>내용</th>
            </tr>
            <tr>
                <td>학과 교육</td>
                <td>20시간 (필수 교육)</td>
                <td>
                    이론 항공법규 2시간<br>
                    항공역학 / 비행이론 5시간<br>
                    항공기상 2시간<br>
                    비행운용 이론 11시간<br>
                    (자체 시험, 교통안전공단 학과시험 면제)
                </td>
            </tr>
            <tr>
                <td>모의비행교육</td>
                <td>10시간</td>
                <td>시뮬레이션 기체 및 입문용 드론 교육</td>
            </tr>
            <tr>
                <td>실기교육</td>
                <td>10시간</td>
                <td>
                    1. 조종기 조작법<br>
                    2. 이륙비행<br>
                    3. 직진 및 후진 수평비행<br>
                    4. 삼각비행<br>
                    5. 마름모비행<br>
                    6. 측풍접근 및 착륙<br>
                    (드론아카데미 자체비행장 실기시험 응시)
                </td>
            </tr>
            <tr>
                <td colspan="3">총 교육시간 40시간 (필수)</td>
            </tr>
        </table>
        
        <h2>속성 교육과정 안내</h2>
        <p>속성 교육과정은 짧은 시간 내에 드론 조종과 기본 운용 능력을 배울 수 있는 집중 과정입니다.</p>
        
        <h3>장점</h3>
        <ul>
            <li>짧은 기간 내에 드론 조종 기초 습득</li>
            <li>자격증 취득을 위한 실질적인 준비 과정</li>
            <li>시간적, 경제적 부담 감소</li>
            <li>바쁜 일정을 가진 학습자에게 유연한 학습 기회 제공</li>
        </ul>
        
        <h3>단점</h3>
        <ul>
            <li>전문 교육 과정에 비해 상대적으로 얕은 지식 습득</li>
            <li>심화 학습과 다양한 실습 기회 부족</li>
            <li>전문적인 드론 운용 능력 향상에 한계 있을 수 있음</li>
            <li>학과 시험을 교육센터 외 장소에 치러야 한다는 부담감이 있음</li>
        </ul>
        
        <h3>속성 교육 과정 상세 내용</h3>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>과정</th>
                <th>시간</th>
                <th>내용</th>
            </tr>
            <tr>
                <td>학과 교육</td>
                <td>6시간 (선택교육 5인 이상)</td>
                <td>
                    이론 항공법규 1시간<br>
                    항공역학 / 비행이론 2시간<br>
                    항공기상 1시간<br>
                    비행운용 이론 2시간<br>
                    (교통안전공단 학과시험)
                </td>
            </tr>
            <tr>
                <td>모의비행교육</td>
                <td>3시간 (필수)</td>
                <td>시뮬레이션 기체 및 입문용 드론 교육</td>
            </tr>
            <tr>
                <td>실기교육</td>
                <td>6시간 (필수)</td>
                <td>
                    1. 조종기 조작법<br>
                    2. 이륙비행<br>
                    3. 직진 및 후진 수평비행<br>
                    4. 삼각비행<br>
                    5. 마름모비행<br>
                    6. 측풍접근 및 착륙<br>
                    (교육원 자체비행장 실기시험 응시)
                </td>
            </tr>
            <tr>
                <td colspan="3">총 교육시간 15시간 (필수 9시간 선택 6시간)</td>
            </tr>
        </table>
    </section>
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
