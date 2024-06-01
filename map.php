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
    <title>오시는 길 - 건국대 GLOCAL(글로컬)캠퍼스</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        h1 {
            color: #2C3E50;
        }
        h2 {
            color: #16A085;
        }
        h3 {
            color: #2980B9;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px 0;
            text-align: center;
            border-bottom: #16A085 3px solid;
        }
        .main-content {
            padding: 20px;
            background: #fff;
            margin-top: 20px;
            border: 1px solid #ddd;
        }
        .main-content h2 {
            color: #16A085;
        }
        .main-content h3 {
            color: #2980B9;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        iframe {
            width: 100%;
            height: 300px;
            border: 0;
        }
        .image-left {
            float: left;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <?php
        require_once "header.php";
    ?>

    <div class="container">
            <h1>오시는 길 - 건국대 GLOCAL(글로컬)캠퍼스</h1>
    </div>
    <section class="main-content container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3188.527410722261!2d127.90573967531013!3d36.94945885927248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x35648631bb18b743%3A0x9424e204471ec0ee!2z6rG06rWt64yA7ZWZ6rWQIOq4gOuhnOy7rOy6oO2NvOyKpA!5e0!3m2!1sko!2skr!4v1716171495248!5m2!1sko!2skr" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    
        <h2>버스정류장</h2>
        <img src="bus.gif" alt="버스 정류장" class="image-left"><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

        <h2>차량 이용시</h2>

        <h3>서울권</h3>
        <ul>
            <li>경부고속도로 - 신갈분기점 - 영동고속도로(강릉방향) - 여주분기점 - 중부내륙고속도로 - 충주 IC - 충주방향 - 건국대사거리(우회전) - 건국대 GLOCAL(글로컬)캠퍼스</li>
            <li>중부고속도로 - 호법분기점 - 영동고속도로(강릉방향) - 여주분기점 - 중부내륙고속도로 - 충주 IC - 충주방향 - 건국대사거리(우회전) - 건국대 GLOCAL(글로컬)캠퍼스</li>
        </ul>

        <h3>호남, 대전권</h3>
        <ul>
            <li>중부고속도로 - 증평 IC - 36번국도 충주방향 - 건국대사거리(우회전) - 건국대 GLOCAL(글로컬)캠퍼스</li>
        </ul>

        <h3>부산, 경상권</h3>
        <ul>
            <li>경부고속도로 - 김천분기점 - 중부내륙고속도로 - 충주 IC - 충주방향 - 건국대사거리(우회전) - 건국대 GLOCAL(글로컬)캠퍼스</li>
        </ul>

        <h3>강릉, 영동권</h3>
        <ul>
            <li>영동고속도로 - 만종분기점 - 중앙고속도로 - 남원주 IC (충주방향) - 19번 국도 - 충주 건국 대사거리 직진 - 건국대 GLOCAL(글로컬)캠퍼스</li>
        </ul>
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
