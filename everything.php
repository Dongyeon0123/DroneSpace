<?php
session_start();
require_once 'db.php';  // 데이터베이스 연결 포함

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo "<script>alert('로그인이 필요합니다.'); window.location.href='login.html';</script>";
    exit;
}

// 게시글 목록 조회
$posts = [];
if ($stmt = $conn->prepare("SELECT p.postnum, p.memberid, p.posttitle, p.postcontent, p.postdate, m.name, (SELECT COUNT(*) FROM likes WHERE postnum = p.postnum) as like_count FROM post p JOIN membertbl m ON p.memberid = m.memberid ORDER BY p.postdate DESC")) {
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
    $stmt->close();
} else {
    echo "SQL 문을 준비하는데 오류가 발생했습니다: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>커뮤니티 게시판</title>
    <link rel="stylesheet" href="main.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #4A54E1;
        }
        .post {
            padding: 15px;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            cursor: pointer;
        }
        .post h2 {
            font-size: 24px;
            margin: 0 0 10px 0;
        }
        .post p {
            margin: 5px 0;
        }
        .post:hover {
            background-color: #f9f9f9;
        }
        button {
            padding: 10px 15px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            background-color: #5C67F2;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #4a54e1;
        }
        .delete-button {
            background-color: #FF4B4B;
        }
        .delete-button:hover {
            background-color: #D43F3F;
        }
        .like-icon {
            color: grey;
            cursor: pointer;
        }
        .like-icon.liked {
            color: red;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="main.php"><img src="logo.png"></a>
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
                    <a href="area.php"><li>지역별</li></a>
                    <a href="certificate.php"><li>자격증별</li></a>
                </ul>
            </li>
            <li>
                <span style="color: red;">커뮤니티</span>
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
                    <a href="application.php"><li>구인&구직 신청 현황</li></a>
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
    <div class="container">
        <h1>커뮤니티 게시판</h1>
        <button onclick="location.href='post_form.php'">게시글 작성</button>
        <div>
            <?php foreach ($posts as $post): ?>
                <div class="post" onclick="viewPost(<?= $post['postnum']; ?>)">
                    <h2><?= htmlspecialchars($post['posttitle']); ?></h2>
                    <p><?= nl2br(htmlspecialchars($post['postcontent'])); ?></p>
                    <p>작성자: <?= htmlspecialchars($post['name']); ?></p>
                    <p>게시일: <?= htmlspecialchars($post['postdate']); ?></p>
                    <p><i id="like-icon-<?= $post['postnum']; ?>" class="far fa-heart like-icon <?= ($post['like_count'] > 0 ? 'liked' : '') ?>" onclick="event.stopPropagation(); toggleLike(<?= $post['postnum']; ?>, '<?= $_SESSION['memberid']; ?>');"></i> : <span id="like-count-<?= $post['postnum']; ?>"><?= $post['like_count']; ?></span></p>
                    <?php if ($_SESSION['memberid'] == $post['memberid']): ?><br><br>
                        <button onclick="event.stopPropagation(); editPost(<?= $post['postnum']; ?>)">수정</button>
                        <button class="delete-button" onclick="event.stopPropagation(); deletePost(<?= $post['postnum']; ?>)">삭제</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
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
                        <li><a href="area.php">지역별</a></li>
                        <li><a href="certificate.php">자격증별</a></li>
                    </ul>
            </div>
            <div>
                <h2><span class="menuli">커뮤니티</span></h2>
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
                        <li><a href="application.php">구인&구직 신청 현황</a></li>
                        <li><a href="mycer.php">내 이력서</a></li>
                    </ul>
            </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function toggleMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.toggle('show');
        }
        
        // 하위 메뉴 링크 클릭 시 메뉴 숨기기
        document.querySelectorAll('.menu-overlay-content ul li ul li a').forEach(function(link) {
            link.addEventListener('click', function() {
                var menuOverlay = document.getElementById('menuOverlay');
                menuOverlay.classList.remove('show');
            });
        });

        function closeMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.remove('show');  // 'show' 클래스를 제거하여 팝업 숨김
        }
        function viewPost(postnum) {
            location.href = 'post_detail.php?postnum=' + postnum;
        }

        function editPost(postnum) {
            if (confirm('게시글을 수정하시겠습니까?')) {
                location.href = 'edit_post_form.php?postnum=' + postnum;
            }
        }

        function deletePost(postnum) {
            if (confirm('정말로 삭제하시겠습니까?')) {
                $.post('delete_post.php', { postnum: postnum }, function(data) {
                    alert('게시글이 삭제되었습니다.');
                    window.location.href = 'everything.php';
                });
            }
        }

        function toggleLike(postnum, memberid) {
            $.post('like_toggle.php', { postnum: postnum, memberid: memberid }, function(data) {
                var response = JSON.parse(data);
                if (response.liked) {
                    $('#like-icon-' + postnum).addClass('liked').removeClass('far').addClass('fas');
                } else {
                    $('#like-icon-' + postnum).removeClass('liked').addClass('far').removeClass('fas');
                }
                $('#like-count-' + postnum).text(response.like_count);
            });
        }
    </script>
</body>
</html>
