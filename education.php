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
    <title>운영자교육</title>
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
        .main-content h2, .main-content h3 {
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
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
            <h1>드론 운용자 교육</h1>
            <p>드론 운용자 교육 과정 안내</p>
        </div>
    </section>

    <section class="main-content container">
        <h2>교육목표</h2>
        <p>드론 운용의 현장 적용, 교육에서 실무로의 전환. 이 교육 과정은 참가자들이 단순히 드론 자격증을 넘어, 드론을 실제 업무에 자신 있게 적용할 수 있는 실질적인 능력을 갖출 수 있도록 설계되었습니다. 드론을 이용한 인프라 점검뿐만 아니라, 비행 허가, 항공 촬영 허가 절차 및 관련 법규에 대한 심층적인 이해를 바탕으로, 드론 운용에 있어 꼭 필요한 드론 원스톱 업무 수행 능력을 갖추는 것이 목표입니다.</p>
        
        <h2>교육의 필요성</h2>
        <p>많은 이들이 운전면허를 취득한 후에도 실제 도로에서 운전하는 것을 주저하는 것처럼, 드론 자격증을 취득한 많은 사람들이 실제 업무에 드론을 적용하는 데 있어 망설임을 느낍니다. 이는 현재의 드론 교육이 자격증 취득에 초점을 맞추고 있어, 실제 현장에서 드론을 운용하는 데 필요한 실무적인 기술과 자신감을 충분히 제공하지 못하기 때문입니다.</p>
        
        <h2>교육대상</h2>
        <ul>
            <li>드론을 업무에 활용하고자 하는 공무원, 공공기관 및 기업체 임직원.</li>
            <li>드론 운용에 관심 있는 단체</li>
        </ul>
        
        <h2>교육 커리큘럼 개요</h2>
        <table>
            <tr>
                <th>구분</th>
                <th>세부 내용</th>
                <th>시간</th>
            </tr>
            <tr>
                <td>드론 운용의 실무적 적용</td>
                <td>실제 업무에서 드론 운용의 중요성과 역할<br>드론을 활용한 인프라 점검의 사례 연구<br>현장에서의 드론 활용 전략</td>
                <td>1시간</td>
            </tr>
            <tr>
                <td>비행 허가 및 항공 촬영 허가 절차</td>
                <td>비행 허가 및 항공 촬영 허가의 심화 이해<br>실제 사례를 통한 허가 신청 절차 분석<br>문제 발생 시 대응 전략</td>
                <td>1시간</td>
            </tr>
            <tr>
                <td>관련 법규 및 실무적 적용</td>
                <td>드론 운용에 있어 필수적인 법규의 심층 분석<br>법규를 고려한 비행 계획 수립<br>법적 이슈 대응 전략</td>
                <td>1시간</td>
            </tr>
            <tr>
                <td>인프라 점검 실무 실습</td>
                <td>실제 인프라 점검 이전(비행 능력도 점검)<br>실제 인프라 점검 프로젝트 준비 및 실습<br>실습을 통한 데이터 수집 및 분석<br>문제 해결 및 실무 적용 능력 강화<br>수집된 데이터 추출 및 관리</td>
                <td>7시간</td>
            </tr>
            <tr>
                <td colspan="3">총 교육시간 10시간</td>
            </tr>
        </table>
        
        <h2>교육 기대 효과</h2>
        <p>이 교육 과정을 통해, 참가자들은 드론 자격증을 취득한 후에도, 실무에서 드론을 자신 있게 활용할 수 있는 역량을 갖추게 됩니다. 이는 실용적인 기술 습득을 통해 드론 운용에 대한 자신감을 높이고, 드론 기술의 현장 적용 범위를 확장하는 데 기여합니다.</p>
        <p>드론 기술의 지속적인 발전에 발맞추어, 우리의 드론 교육 프로그램도 이론적 지식에서 실용적 응용으로의 전환을 추구합니다. 이 과정은 개인과 기업, 기관 모두에게 실질적인 이점을 제공함으로써, 드론 운용에 관한 통합 솔루션을 제공하는 데 있어 우리의 전문성을 강화합니다.</p>
    </section>
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