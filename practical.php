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
    <title>실기평가자</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
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
            padding: 10px;
        }
        th {
            background-color: #f4f4f4;
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
    <section class="showcase">
        <div class="container">
            <h1>드론 실기평가자 과정</h1>
            <p>드론 실기평가자 교육 과정 안내</p>
        </div>
    </section>

    <section class="main-content container">
        <h2>과정소개</h2>
        <p>초경량 비행장치 실기평가자는 드론 조종사의 실력을 공정하고 정확하게 평가하는 중요한 역할을 담당합니다.
        본 과정은 실기평가자가 되기 위한 전문 교육과정을 제공하며, 드론 산업의 전문가로서의 여정을 시작하는 데 필요한
        모든 지식과 기술을 갖추도록 설계되었습니다.</p>
        
        <h2>드론 자격증 과정 요약</h2>
        <ul>
            <li>1단계: 초경량비행장치 1종 조종자 자격 취득; 필기 시험 통과 후 20시간 비행 훈련 및 실기 시험 통과</li>
            <li>2단계: 1종 자격증 취득 후, 80시간 추가 비행 시간 및 2박 3일 집체 교육을 통한 필기시험 합격</li>
            <li>3단계: 지도조종자 자격증 취득 후, 50시간 추가 비행 시간 및 실기평가자 시험 준비</li>
        </ul>

        <h2>실기평가자 시험 준비 과정</h2>
        <ul>
            <li>교양 교육: 실기평가자로서 필요한 기본 지식 및 교양 교육</li>
            <li>실기 시험: 1종 조종자 시험 코스를 에티모드(자세제어모드)로 통과. 센서 감지를 통한 평가</li>
        </ul>

        <h2>실기시험위원 자격 취득</h2>
        <p>실기평가자 자격증 취득 후 실기시험위원으로의 자격 취득 가능. 한국교통안전공단에서 위촉.</p>

        <h2>교육 커리큘럼 개요</h2>
        <table>
            <tr>
                <th>분류</th>
                <th>내용</th>
                <th>시간</th>
            </tr>
            <tr>
                <td>기본 비행 기술 연습</td>
                <td>호버링, 이륙 및 착륙 기술</td>
                <td>20시간</td>
            </tr>
            <tr>
                <td></td>
                <td>기본 조종 기술 (전진, 후진, 좌/우 회전, 상승/하강)</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>비상 상황 대처 연습</td>
                <td></td>
            </tr>
            <tr>
                <td>고급 비행 기술 연습</td>
                <td>에티모드(자세제어모드)에서의 정밀 조종 연습</td>
                <td>15시간</td>
            </tr>
            <tr>
                <td></td>
                <td>다양한 비행 경로 및 패턴 연습</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>고급 비상 상황 대처 및 회복 기술</td>
                <td></td>
            </tr>
            <tr>
                <td>실기 평가 준비</td>
                <td>1종 조종자 시험 코스 전반에 대한 심화 연습</td>
                <td>15시간</td>
            </tr>
            <tr>
                <td></td>
                <td>평가 기준에 따른 비행 기술 점검 및 개선</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>실제 평가 환경에서의 모의 실기 시험</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">총 교육시간 50시간</td>
            </tr>
        </table>
        
        <h2>교육 신청 및 문의</h2>
        <p>초경량 비행장치 실기평가자 교육 과정은 드론 조종의 전문가가 되고자 하는 분들에게 필수적인 과정입니다.
        본 과정을 통해 여러분은 공정하고 정확한 실기 평가를 수행할 수 있는 능력을 갖추게 될 것입니다.</p>
    </section>
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
            <h2 style="color: red;">국가 자격증</h2>
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