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
    <title>Drone Space 비전</title>
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
        }
        .vision-section {
            text-align: center;
            padding: 50px 20px;
            background-color: #fff;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .vision-section h2 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 20px;
            display: inline-block;
            border-bottom: 3px solid #333; /* 글자 색상과 일치하는 밑줄 색상 */
        }
        .vision-banner {
            background: url('path-to-your-image.png') no-repeat center center/cover;
            color: white;
            padding: 60px 20px;
            margin: 0 auto;
            max-width: 1200px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .vision-banner::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            z-index: 1;
        }
        .vision-banner p {
            font-size: 1.2em;
            line-height: 1.5em;
            margin: 0;
            font-weight: bold;
            position: relative;
            z-index: 2;
        }
        .vision-banner .main-quote {
            font-size: 1.8em; /* 폰트 크기 1.5배로 설정 */
        }
        .vision-items {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        .vision-item {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            flex: 1;
            margin: 10px;
            max-width: 250px;
            transition: transform 0.3s ease;
        }
        .vision-item:hover {
            transform: translateY(-10px);
        }
        .vision-item img {
            width: 50px;
            height: 50px;
        }
        .vision-item .sub-quote {
            font-size: 1.3em; /* 폰트 크기 1.3배로 설정 */
            color: #0779e4;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .vision-item .description {
            font-size: 1em; /* 본문 내용은 기본 폰트 크기 */
            color: #333;
            font-weight: normal;
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
    <?php
        require_once "header.php";
    ?>

    <section class="vision-section">
        <h2>Drone Space 비전</h2>
        <div class="vision-banner">
            <p class="main-quote">"드론일자리 창출을 통한 사회적 가치 창출"</p>
            <br>
            <p>드론 기술의 선도자가 되어, 우리는 지속 가능한 미래와 기술 혁신을 위해 정보의 집합체를 만든다.<br>전문 지식과 드론시장의 동향을 파악하여 드론 산업의 다양한 연구를 충족시킬 수 있도록 지원하며, 실질적인 기회를 제공합니다.</p>
        </div>
        <div class="vision-items">
            <div class="vision-item">
                <img src="v1.png" >
                <p class="sub-quote">정보제공을 통한 혁신</p>
                <p class="description">보다 더 전문적인 정보를 제공하여 기술적 진입장벽을 낮추겠습니다.</p>
            </div>
            <div class="vision-item">
                <img src="v2.png" >
                <p class="sub-quote">구인구직 중개시스템 구축</p>
                <p class="description">구인자는 사이트를 통해 검증된 <br>구직자를 구할 수 있습니다.</p>
            </div>
            <div class="vision-item">
                <img src="v3.png" >
                <p class="sub-quote">상호평가 시스템</p>
                <p class="description">사이트 이용자간 평가를 통해 <br>개인 신뢰도 반영합니다.</p>
            </div>
            <div class="vision-item">
                <img src="v4.png" >
                <p class="sub-quote">무한한 성장가능성</p>
                <p class="description">최신기술의 트랜드 파악과 학습을 통해 앞으로의 변화를 예측하여 <br>선도하겠습니다.</p>
            </div>
        </div>
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
