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
    <title>인사말</title>
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
        }
        .menuli {
            color: red;
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
    <?php
        require_once "header.php";
    ?>
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
                <h2>관련 연락처 : 010-3200-1951 이동연</h2>
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
