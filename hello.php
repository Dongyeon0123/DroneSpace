<?php
// 세션 시작
session_start();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>인사말</title>
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
        .menuli {
            color: red;
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
        .main {
            padding: 20px;
            background: #fff;
        }
        .main h1 {
            margin-top: 0;
        }
        .main .content {
            display: flex;
            align-items: flex-start;
        }
        .main .content img {
            float: left;
            margin-right: 20px;
            width: 300px; /* 원하는 이미지 크기로 조정 */
            height: auto;
        }
        .main p.first {
            font-size: 2em; /* 폰트 크기를 2배로 설정 */
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

    <section class="main container">
        <div class="content">
            <img src="logo.png"> <!-- 이미지 경로를 넣으세요 -->
            <div>
                <p class="first">안녕하십니까 건국대학교 컴퓨터공학과 팀 Drone Space 입니다.</p>
                <p> Drone Space에 오신 것을 진심으로 환영합니다! 드론 기술이 열어주는 무한한 가능성의 세계로 여러분을 초대하게 되어 기쁩니다. 저희 Drone Space는 이 혁신적인 기술의 전문가를 양성하는 데 앞장서고 있으며, 드론 구인구직 시장을 함께 제공하고 있습니다.</p>
                <p> 드론 산업의 빠른 성장과 그 중요성은 우리에게 새로운 기회의 문을 열어줍니다. 저희 Drone Space는 드론 기술의 기초부터 고급 조종 기술, 안전 관리, 그리고 교육 방법론에 이르기까지 다양한 정보를 제공합니다. 이를 통해 참가자 여러분은 드론 산업에서 필요한 다양한 역량을 습득하고, 미래 산업의 변화를 이끄는 전문가로 성장할 수 있습니다. 뿐만 아니라, 저희는 드론 전문가들이 적합한 일자리를 찾을 수 있도록 구인구직 시장을 운영하고 있습니다. 이를 통해 여러분은 바로 드론 산업에서의 커리어를 시작할 수 있습니다.</p>
                <p>드론 기술의 발전은 우리의 상상을 초월하는 새로운 경험과 기회를 제공합니다. 여러분이 이 흥미로운 여정에 함께 하실 때, 우리는 더 밝은 미래로 나아갈 수 있습니다. 여러분의 열정과 창의력이 이 산업의 미래를 형성하는 데 중요한 역할을 할 것입니다.</p>
                <p>저희 Drone Space는 건국대학교 재학생이 만든 국내최초 드론구인구직 플랫폼입니다.</p>
                <p>드론 자격증 12만 시대, 드론 기술이 현대 산업에 혁신적인 변화를 가져옴에 따라 정밀한 데이터 수집 및 관리를 가능하게 하고, 드론 기술 구인구직에 있어서 도움이 되고자 위 플랫폼을 창설했습니다. 현재 드론 기술에 있어서 전문 드론 조종사에 대한 수요가 지속적으로 증가하고 있습니다. 이에 저희는 드론 자격 증명을 보다 용이하게 하고, 최초로 구인구직 기능을 도입함으로써 드론 시장을 활성화하겠습니다.</p>
                <p>드론의 세계로 여러분을 초대하며, 저희 Drone Space가 여러분의 꿈을 실현하는 데 함께할 수 있기를 기대합니다. 여러분의 무한한 가능성을 펼칠 준비가 되어 있습니다. 함께 미래 드론시장을 이끌어 갑시다.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>Copyright &copy; 2024 Drone Space</p>
    </footer>
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
