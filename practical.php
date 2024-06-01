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
    <?php
        require_once "header.php";
    ?>
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