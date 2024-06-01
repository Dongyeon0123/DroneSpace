<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>드론 스페이스</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header class="header" id="mainHeader">
        <a href="main.php"><img src="logo1.png"></a>
        <ul class="menu">
            <li>
                기업 소개
                <ul>
                    <a href="hello.php"><li>인사말</li></a>
                    <a href="history.php"><li>DroneSpace 연혁</li></a>
                    <a href="vision.php"><li>아카데미 비전</li></a>
                    <a href="facility.php"><li>시설 현황</li></a>
                    <a href="map.php"><li>오시는 길</li></a>
                </ul>
            </li>
            <li>
                국가 자격증
                <ul>
                    <a href="information.php"><li>국가 자격증 안내</li></a>
                    <a href="money.php"><li>교육비 지원 안내</li></a>
                    <a href="company.php"><li>기관/단체 교육 안내</li></a>
                    <a href="type1.php"><li>1종 조종자 과정</li></a>
                    <a href="type2.php"><li>2종 조종자 과정</li></a>
                    <a href="type3.php"><li>3종 조종자 과정</li></a>
                    <a href="education.php"><li>드론 운용자 교육</li></a>
                    <a href="instructor.php"><li>지도 조종자 과정</li></a>
                    <a href="practical.php"><li>실기 평가자 과정</li></a>
                </ul>
            </li>
            <li>
                구인 & 구직
                <ul>
                    <a href="recruitment.php"><li>전체 구인글</li></a>
                </ul>
            </li>
            <li>
                커뮤니티
                <ul>
                    <a href="everything.php"><li>전체글</li></a>
                    <a href="hot.php"><li>HOT글</li></a>
                    <a href="ask.php"><li>1대1 질문 게시판</li></a>
                </ul>
            </li>
            <li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php">로그아웃</a>
                <?php else: ?>
                    <a href="login.html">로그인 / 회원가입</a>
                <?php endif; ?>
            </li>
            <li>
                마이 페이지
                <ul>
                    <a href="mywrite.php"><li>내가 작성한 게시글</li></a>
                    <a href="myreply.php"><li>내가 작성한 댓글</li></a>
                    <a href="myrecruit.php"><li>구인&구직 신청 현황</li></a>
                    <a href="mycer.php"><li>내 이력서</li></a>
                </ul>
            </li>
        </ul>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>

    <header class="scroll-header" id="scrollheader">
        <a href="main.php"><img src="logo1.png"></a>
        <ul class="menu">
            <li>
                기업 소개
                <ul>
                    <a href="hello.php"><li>인사말</li></a>
                    <a href="history.php"><li>DroneSpace 연혁</li></a>
                    <a href="vision.php"><li>아카데미 비전</li></a>
                    <a href="facility.php"><li>시설 현황</li></a>
                    <a href="map.php"><li>오시는 길</li></a>
                </ul>
            </li>
            <li>
                국가 자격증
                <ul>
                    <a href="information.php"><li>국가 자격증 안내</li></a>
                    <a href="money.php"><li>교육비 지원 안내</li></a>
                    <a href="company.php"><li>기관/단체 교육 안내</li></a>
                    <a href="type1.php"><li>1종 조종자 과정</li></a>
                    <a href="type2.php"><li>2종 조종자 과정</li></a>
                    <a href="type3.php"><li>3종 조종자 과정</li></a>
                    <a href="education.php"><li>드론 운용자 교육</li></a>
                    <a href="instructor.php"><li>지도 조종자 과정</li></a>
                    <a href="practical.php"><li>실기 평가자 과정</li></a>
                </ul>
            </li>
            <li>
                구인 & 구직
                <ul>
                    <a href="recruitment.php"><li>전체 구인글</li></a>
                </ul>
            </li>
            <li>
                커뮤니티
                <ul>
                    <a href="everything.php"><li>전체글</li></a>
                    <a href="hot.php"><li>HOT글</li></a>
                    <a href="ask.php"><li>1대1 질문 게시판</li></a>
                </ul>
            </li>
            <li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" style="color: black;">로그아웃</a>
                <?php else: ?>
                    <a href="login.html" style="color: black;">로그인 / 회원가입</a>
                <?php endif; ?>
            </li>
            <li>
                마이 페이지
                <ul>
                    <a href="mywrite.php"><li>내가 작성한 게시글</li></a>
                    <a href="myreply.php"><li>내가 작성한 댓글</li></a>
                    <a href="myrecruit.php"><li>구인&구직 신청 현황</li></a>
                    <a href="mycer.php"><li>내 이력서</li></a>
                </ul>
            </li>
        </ul>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>

    <div class="menu-overlay" id="menuOverlay">
        <div class="image-container">
            <a href="main.php"><img src="logo.png"></a>
        </div>
        <div class="menu-overlay-content">
            <span class="close-btn" onclick="closeMenu()">X</span>
            <div>
                <h2>기업 소개</h2>
                    <ul>
                        <li><a href="hello.php">인사말</a></li>
                        <li><a href="history.php">DroneSpace 연혁</a></li>
                        <li><a href="vision.php">아카데미 비전</a></li>
                        <li><a href="facility.php">시설 현황</a></li>
                        <li><a href="map.php">오시는 길</a></li>
                    </ul>
            </div>
            <div>
                <h2>국가 자격증</h2>
                    <ul>
                        <li><a href="information.php">국가 자격증 안내</a></li>
                        <li><a href="money.php">교육비 지원 안내</a></li>
                        <li><a href="company.php">기관/단체 교육 안내</a></li>
                        <li><a href="type1.php">1종 조종자 과정</a></li>
                        <li><a href="type2.php">2종 조종자 과정</a></li>
                        <li><a href="type3.php">3종 조종자 과정</a></li>
                        <li><a href="education.php">드론 운용자 교육</a></li>
                        <li><a href="instructor.php">지도 조종자 과정</a></li>
                        <li><a href="practical.php">실기 평가자 과정</a></li>
                    </ul>
            </div>
            <div>
                <h2>구인 & 구직</h2>
                    <ul>
                        <li><a href="recruitment.php">전체 구인글</a></li>
                    </ul>
            </div>
            <div>
                <h2>커뮤니티</h2>
                    <ul>
                        <li><a href="everything.php">전체글</a></li>
                        <li><a href="hot.php">HOT글</a></li>
                        <li><a href="ask.php">1대1 질문 게시판</a></li>
                    </ul>
            </div>
            <div style="margin-top: 24px;">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" style="color: white; font-size: 24px;">로그아웃</a>
                <?php else: ?>
                    <a href="login.html" style="color: white; font-size: 24px;">로그인 / 회원가입</a>
                <?php endif; ?>
            </div>
            <div>
                <h2>마이 페이지</h2>
                    <ul>
                        <li><a href="mywrite.php">내가 작성한 게시글</a></li>
                        <li><a href="myreply.php">내가 작성한 댓글</a></li>
                        <li><a href="myrecruit.php">구인&구직 신청 현황</a></li>
                        <li><a href="mycer.php">내 이력서</a></li>
                    </ul>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('scroll', function() {
            const scrollheader = document.getElementById('scrollheader');
            const mainHeader = document.getElementById('mainHeader');
            if (window.scrollY > 150) {
                mainHeader.style.top = '-130px';
                scrollheader.style.top = '0px';
            } else {
                mainHeader.style.top = '0px';
                scrollheader.style.top = '-130px';
            }
        });
    </script>
</body>
</html>
