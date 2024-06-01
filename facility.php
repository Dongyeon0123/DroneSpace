<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>시설 현황</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="main.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .grid-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 300px; /* 고정 높이 설정 */
        }
        .grid-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }
        .grid-item:hover img {
            transform: scale(1.1);
        }
        .grid-item .caption {
            position: absolute;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            width: 93%;
            text-align: center;
            padding: 10px;
            color: white;
            font-size: 16px;
            transition: background 0.5s ease;
        }
        .grid-item:hover .caption {
            background: rgba(0, 0, 0, 0.8);
        }
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .footer a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php
        require_once "header.php";
    ?>

    <div class="container">
        <h1>시설 현황</h1>
        <div class="grid-container">
            <div class="grid-item">
                <img src="f1.webp" alt="시설 이미지 1">
                <div class="caption">학교 운동장</div>
            </div>
            <div class="grid-item">
                <img src="f2.jpeg" alt="시설 이미지 2">
                <div class="caption">학교 광장</div>
            </div>
            <div class="grid-item">
                <img src="f3.jpeg" alt="시설 이미지 3">
                <div class="caption">드론 스페이스 연회실</div>
            </div>
            <div class="grid-item">
                <img src="f4.jpeg" alt="시설 이미지 4">
                <div class="caption">드론 스페이스 사무실</div>
            </div>
            <div class="grid-item">
                <img src="f5.jpeg" alt="시설 이미지 5">
                <div class="caption">드론 스페이스 장비</div>
            </div>
            <div class="grid-item">
                <img src="f6.jpeg" alt="시설 이미지 6">
                <div class="caption">드론 스페이스 강의실</div>
            </div>
            <div class="grid-item">
                <img src="f7.jpeg" alt="시설 이미지 7">
                <div class="caption">드론 조립실</div>
            </div>
            <div class="grid-item">
                <img src="f8.webp" alt="시설 이미지 8">
                <div class="caption">드론 스페이스 연구동</div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>Copyright &copy; 2024 Drone Space</p>
    </footer>
</body>
</html>
