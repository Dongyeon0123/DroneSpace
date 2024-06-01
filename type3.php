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
    <title>3종 과정</title>
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
    </style>
</head>
<body>
    <?php
        require_once "header.php";
    ?>
    <section class="showcase">
        <div class="container">
            <h1>드론 국가자격증 3종 과정</h1>
            <p>드론 조종 및 운용에 대한 깊이 있는 이해와 전문적인 기술 습득을 목표로 합니다.</p>
        </div>
    </section>
    <section class="main-content container">
        <h2>취득 시 운용 가능 기체</h2>
        <p>2kg이상 ~ 7kg미만</p>
        
        <h2>취득 시 활용 분야</h2>
        <ul>
            <li>관공서 공공기관 취업</li>
            <li>드론촬영</li>
            <li>드론제작/ 개발/ 정비/교육 등</li>
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
                <td>6시간</td>
                <td>시뮬레이션 기체 및 입문용 드론 교육</td>
            </tr>
            <tr>
                <td>실기교육</td>
                <td>6시간</td>
                <td>
                    1. 조종기 조작법<br>
                    2. 이륙비행<br>
                    3. 직진 및 후진 수평비행<br>
                    4. 삼각비행<br>
                    (드론아카데미 차체비행장 실기시험 응시)
                </td>
            </tr>
            <tr>
                <td colspan="3">총 교육시간 32시간 (필수)</td>
            </tr>
        </table>
        
        <h2>속성 교육과정 안내</h2>
        <p>짧은 시간 내에 드론 조종과 기본 운용 능력을 배울 수 있는 집중 과정입니다.</p>
        
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
                    (교육원 차체비행장 실기시험 응시)
                </td>
            </tr>
            <tr>
                <td colspan="3">총교육시간 15시간 (필수 9시간 선택 6시간)</td>
            </tr>
        </table>
    </section>
    <footer class="footer">
        <p>Copyright &copy; 2024 Drone Space</p>
    </footer>
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
