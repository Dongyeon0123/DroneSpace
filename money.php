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
    <title>교육비 지원</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding-bottom: 70px;
        }
        .main-content {
            padding: 20px;
            background: #fff;
            margin-top: 20px;
        }
        .main-content h2, .main-content h3 {
            color: #333;
        }
        .main-content p, .main-content ul {
            margin-bottom: 20px;
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
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        .header-icons span {
            margin-right: 10px;
        }
        .menu-icons {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }
        .menu-icons div {
            flex: 1;
            text-align: center;
            padding: 10px;
            background: #ddd;
            margin: 5px;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding-bottom: 70px;
        }
        .showcase {
            background: #333 url('drone.jpg') no-repeat 0 -400px;
            text-align: center;
            color: #fff;
        }
        .showcase h1 {
            margin-top: 70px;
            font-size: 55px;
            margin-bottom: 10px;
        }
        .showcase p {
            font-size: 15px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <?php
        require_once "header.php";
    ?>
    <section class="showcase">
        <div class="container">
            <h1>교육비지원</h1>
        </div>
    </section>

        <section class="main-content container">
            <h2>교육비지원안내</h2>
            <p>국민내일배움카드 교육비 지원 안내</p>
            <p>국민내일배움카드를 통한 교육비 지원은 국민 누구나 질 높은 직업 교육을 받을 수 있도록 고용노동부에서 마련한 제도입니다. 현재 시스템은 준비 중에 있으며, 다음과 같은 내용으로 구성됩니다.</p>

            <h3>교육비 지원 안내</h3>
            <table>
                <tr>
                    <th>항목</th>
                    <th>내용</th>
                </tr>
                <tr>
                    <td>소관기관</td>
                    <td>고용노동부</td>
                </tr>
                <tr>
                    <td>신청방법</td>
                    <td>가까운 고용센터 또는 HRD-Net을 통해 신청</td>
                </tr>
                <tr>
                    <td>지원내용</td>
                    <td>5년간 300~500만원 한도 내에서 인정받은 적합훈련과정 수강 시 훈련비의 일부 또는 전액 지원</td>
                </tr>
                <tr>
                    <td>지원대상</td>
                    <td>국민 누구나</td>
                </tr>
                <tr>
                    <td>지원 제외 대상</td>
                    <td>공무원, 사립학교 교직원, 특정 소득 이상 자영업자, 대규모기업 근로자 등</td>
                </tr>
                <tr>
                    <td>선정기준</td>
                    <td>직업경력, 직업 능력 수준 등을 고려한 훈련 필요성 평가</td>
                </tr>
                <tr>
                    <td>신청절차</td>
                    <td>구직등록 → 카드발급 신청 → 훈련상담 및 수강신청 → 훈련수강</td>
                </tr>
            </table>
        </section>
    </div>
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