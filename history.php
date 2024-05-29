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
    <title>연혁</title>
    <style>
        @charset "utf-8";
        .container {
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
        }
        .search-container {
            text-align: center;
            padding: 20px;
            padding-bottom: 2px;
        }
        #searchInput {
            padding: 18px 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 50%;
        }
        #searchInput:focus {
            outline: none;
            border-color: blue;
        }
        #searchButton {
            padding: 19px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
        }
        #searchButton:hover {
            background-color: #0056b3;
        }
        .content-background {
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            transition: background-image 1s ease-in-out;
        }
        .content {
            text-align: left;
            margin: 70px 150px;
            padding: 50px;
            border-radius: 10px;
            color: white;
        }
        .notice {
            font-size: 32px;
        }
        .content hr {
            width: 50px;
            height: 3px;
            background-color: #fff;
            border: none;
            margin: 20px 0;
        }
        .content span {
            display: block;
            margin-top: 20px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 150px;
        }
        .grid-item {
            display: flex;
            align-items: center;
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .grid-item img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-right: 20px;
        }
        .grid-item p {
            margin: 0;
        }
        .section {
            background-color: #fff;
            padding: 50px 150px;
            margin: 20px 0;
        }
        .section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        .section p {
            font-size: 18px;
            line-height: 1.6;
        }
        .section img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 20px;
        }
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }
        .footer a {
            color: white;
            text-decoration: none;
        }
        .main {
            padding: 50px;
            background: #fff;
            font-size: 17px;
            font-weight: bold;
        }
        .main h1 {
            margin-top: 0;
            text-align: center;
            font-size: 2.5em;
            color: #333;
        }
        .timeline {
            position: relative;
            padding: 20px 0;
            list-style: none;
        }
        .timeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #0077C3;
            left: 50%;
            margin-left: -2px;
        }
        .timeline-item {
            margin: 20px 0;
            padding: 20px;
            position: relative;
            width: 45%;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            transition: transform 0.3s;
        }
        .timeline-item:hover {
            transform: translateY(-10px);
        }
        .timeline-item:before {
            content: '';
            position: absolute;
            top: 20px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #0077C3;
            border: 4px solid #fff;
            z-index: 1;
        }
        .timeline-item.left {
            left: 20px;
        }
        .timeline-item.left:before {
            right: -30px;
        }
        .timeline-item.right {
            left: 51%;
        }
        .timeline-item.right:before {
            left: -31px;
        }
        .timeline-content .date {
            font-weight: bold;
            font-size: 20px;
            color: #0077C3;
            margin-bottom: 10px;
        }
        .timeline-content p {
            margin: 0;
            font-size: 1.2em;
        }
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 30px;
            margin-top: 30px;
        }

        @media (max-width: 1200px) {
            .timeline-item {
                width: 70%;
                left: 15%;
            }
            .timeline-item.right {
                left: 15%;
            }
        }
        @media (max-width: 800px) {
            .timeline-item {
                width: 90%;
                left: 5%;
            }
            .timeline-item.right {
                left: 5%;
            }
        }
        @media (max-width: 640px) {
            .timeline:before {
                left: 0;
            }
            .timeline-item {
                width: 100%;
                left: 0;
                padding: 10px;
            }
            .timeline-item.right {
                left: 0;
            }
            .timeline-item:before {
                left: 10px;
                right: auto;
            }
            .main h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <?php
        require_once "header.php";
    ?>
    <section class="main container">
        <h1>연혁</h1>
        <ul class="timeline">
            <li class="timeline-item left">
                <div class="timeline-content">
                    <p class="date">23년 9월 1일</p>
                    <p>KU 건국드론단 창설 (60명)</p>
                </div>
            </li>
            <li class="timeline-item right">
                <div class="timeline-content">
                    <p class="date">23년 11월 24일</p>
                    <p>CELEB 연구원 드론 서포터즈 1기</p>
                </div>
            </li>
            <li class="timeline-item left">
                <div class="timeline-content">
                    <p class="date">24년 2월 24일</p>
                    <p>KU 건국드론단 2기 모집 (61명)</p>
                </div>
            </li>
            <li class="timeline-item right">
                <div class="timeline-content">
                    <p class="date">24년 2월 25일</p>
                    <p>협의체 발대식</p>
                </div>
            </li>
            <li class="timeline-item left">
                <div class="timeline-content">
                    <p class="date">24년 3월 7일</p>
                    <p>중앙동아리 창설 KU 건국드론단 ㅡ> 콤비 명칭 변경</p>
                </div>
            </li>
            <li class="timeline-item right">
                <div class="timeline-content">
                    <p class="date">24년 3월 31일</p>
                    <p>창업동아리 날리자KU 창설</p>
                </div>
            </li>
            <li class="timeline-item left">
                <div class="timeline-content">
                    <p class="date">24년 5월 1일</p>
                    <p>Drone Space 설립</p>
                </div>
            </li>
        </ul>
    </section>

    <footer>
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
