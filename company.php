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
    <title>단체교육</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding-bottom: 10px;
        }
        .showcase {
            background: #333 url('drone.jpg') no-repeat 0 -400px;
            text-align: center;
            color: #fff;
        }
        .showcase h1 {
            margin-top: 45px;
            font-size: 55px;
            margin-bottom: 10px;
        }
        .showcase p {
            font-size: 15px;
            margin-bottom: 43px;
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
            <h1>기관/단체 교육안내</h1>
            <p>KDEC 한국드론교육센터는 인천시, 고양시, 파주시, 서울시 등 지방자치 단체 및 관공서, 공공기관의 드론 운용자들을 대상으로 다년간 단체 교육을 제공해 온 전문 교육기관입니다.<br>교사, 대학생, 공무원 등 다양한 단체의 교육 경험을 바탕으로 체계적이고 전문적인 드론 국가자격증 교육 프로그램을 진행하고 있습니다.</p>
        </div>
    </section>

    <section class="main-content container">
        <h2>전문 교육과정 안내</h2>
        <p>KDEC 한국드론교육센터 전문 교육과정은 드론 조종 및 운용에 대한 깊이 있는 이해와 전문적인 기술 습득을 목표로 합니다. 이 과정은 이론 학습과 실습을 통해 안전한 드론 조종 능력과 고급 운용 기술을 배우고자 하는 개인에게 이상적입니다.</p>
        
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
        <table>
            <tr>
                <th>자격증종류</th>
                <th>교육시간</th>
                <th>학과시험장</th>
                <th>실기시험장</th>
            </tr>
            <tr>
                <td>1종 자격증</td>
                <td>60시간 (필수)</td>
                <td>동국대학교 미래융합교육원 드론아카데미 전산실</td>
                <td>동국대학교 미래융합교육원 드론아카데미 비행장</td>
            </tr>
            <tr>
                <td>2종 자격증</td>
                <td>40시간 (필수)</td>
                <td>동국대학교 미래융합교육원 드론아카데미 전산실</td>
                <td>동국대학교 미래융합교육원 드론아카데미 비행장</td>
            </tr>
            <tr>
                <td>3종 자격증</td>
                <td>32시간 (필수)</td>
                <td>동국대학교 미래융합교육원 드론아카데미 전산실</td>
                <td>동국대학교 미래융합교육원 드론아카데미 비행장</td>
            </tr>
        </table>

        <h2>속성 교육과정 안내</h2>
        <p>속성 교육과정은 짧은 시간 내에 드론 조종과 기본 운용 능력을 배울 수 있는 집중 과정입니다. 이 과정은 드론에 대한 기본적인 이해와 실습을 통해 조종 자격증 취득을 목표로 하는 학습자에게 적합합니다.</p>
        
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
        <table>
            <tr>
                <th>자격증종류</th>
                <th>교육시간</th>
                <th>학과시험장</th>
                <th>실기시험장</th>
            </tr>
            <tr>
                <td>1종 자격증</td>
                <td>29시간 (필수 23시간 선택 6시간)</td>
                <td>교통안전공단 학과시험장</td>
                <td>교통안전공단 실기시험장</td>
            </tr>
            <tr>
                <td>2종 자격증</td>
                <td>19시간 (필수 13시간 선택 6시간)</td>
                <td>교통안전공단 학과시험장</td>
                <td>교통안전공단 실기시험장</td>
            </tr>
            <tr>
                <td>3종 자격증</td>
                <td>15시간 (필수 9시간 선택 6시간)</td>
                <td>교통안전공단 학과시험장</td>
                <td>교통안전공단 실기시험장</td>
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
