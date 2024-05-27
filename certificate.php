<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>구인&구직 게시판</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #333;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #77aaff 3px solid;
        }
        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }
        header ul {
            padding: 0;
            list-style: none;
        }
        header li {
            display: inline;
            padding: 0 20px 0 20px;
        }
        header #branding {
            float: left;
        }
        header #branding h1 {
            margin: 0;
        }
        header nav {
            float: right;
            margin-top: 10px;
        }
        .post {
            display: none;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        .main-content {
            padding: 20px;
            background: #fff;
            margin-top: 20px;
        }
        .main-content h2, .main-content h3 {
            margin-top: 0;
        }
        .main-content label {
            display: block;
            margin: 10px 0 5px;
        }
        .main-content input[type="text"],
        .main-content textarea {
            width: 70%;
            padding: 10px;
            margin-bottom: 10px;
        }
        .region-selection fieldset,
        .region-selection fieldset label {
            width: 70%;
        }

        .region-selection fieldset legend {
            font-size: 1em;
            margin-bottom: 10px;
        }

        .region-selection button[type="reset"] {
            margin-left: 20px;
        }
        .post-creation fieldset,
        .post-creation fieldset label,
        .region-selection fieldset,
        .region-selection fieldset label {
            width: 70%;
        }

        .post-creation fieldset legend,
        .region-selection fieldset legend {
            font-size: 1em;
            margin-bottom: 10px;
        }
        button[type="submit"],
        button[type="reset"] {
            background-color: #4CAF50; /* Green background */
            border: none;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 12px;
        }

        button[type="submit"]:hover,
        button[type="reset"]:hover {
            background-color: #366e39; /* Darker green */
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>구인&구직 게시판</h1>
            </div>
        </div>
    </header>
    <section class="main-content container">
        <div class="post-creation">
            <h2>게시글 작성</h2>
            <form id="postForm">
                <fieldset>
                    <legend>지역 선택</legend>
                    <label>
                        <input type="checkbox" name="postRegion" value="seoul"> 서울
                        <input type="checkbox" name="postRegion" value="gyeonggi"> 경기/인천
                        <input type="checkbox" name="postRegion" value="gangwon"> 강원도
                        <input type="checkbox" name="postRegion" value="chungcheong"> 충청도
                        <input type="checkbox" name="postRegion" value="gyeonsang"> 경상도
                        <input type="checkbox" name="postRegion" value="jeonra"> 전라도
                        <input type="checkbox" name="postRegion" value="jeju"> 제주
                    </label>
                </fieldset>
                <fieldset>
                    <legend>자격증 선택</legend>
                    <label>
                        <input type="checkbox" name="postCertificate" value="1종"> 1종
                        <input type="checkbox" name="postCertificate" value="2종"> 2종
                        <input type="checkbox" name="postCertificate" value="3종"> 3종
                    </label>
                </fieldset>
                <label for="postTitle">제목</label>
                <input type="text" id="postTitle" name="postTitle" required>
                <label for="postContent">내용</label>
                <textarea id="postContent" name="postContent" required></textarea>
                <br><button type="submit">게시글 올리기</button>
            </form>
        </div>
    </section>

    <section class="main-content container">
        <div class="region-selection">
            <h2>게시글 목록</h2>
            <form id="regionForm">
                <fieldset>
                    <legend>지역 선택</legend>
                    <label>
                        <input type="checkbox" name="region" value="seoul"> 서울
                        <input type="checkbox" name="region" value="gyeonggi"> 경기/인천
                        <input type="checkbox" name="region" value="gangwon"> 강원도
                        <input type="checkbox" name="region" value="chungcheong"> 충청도
                        <input type="checkbox" name="region" value="gyeonsang"> 경상도
                        <input type="checkbox" name="region" value="jeonra"> 전라도
                        <input type="checkbox" name="region" value="jeju"> 제주
                    </label>
                </fieldset>
                <fieldset>
                    <legend>자격증 선택</legend>
                    <label>
                        <input type="checkbox" name="certificate" value="1종"> 1종
                        <input type="checkbox" name="certificate" value="2종"> 2종
                        <input type="checkbox" name="certificate" value="3종"> 3종
                        <button type="reset" id="resetButton">리셋</button>
                    </label>
                </fieldset>
            </form>
        </div>

        <div class="posts-list">
            <div id="posts">
                <div class="post" data-region="seoul" data-certificate="1종,2종,3종"></div>
                <div class="post" data-region="gyeonggi" data-certificate="1종,2종"></div>
                <div class="post" data-region="gangwon" data-certificate="3종"></div>
                <!-- 필요한 게시글 추가 -->
                <div class="post" data-region="chungcheong" data-certificate="1종"></div>
                <div class="post" data-region="gyeonsang" data-certificate="2종,3종"></div>
                <div class="post" data-region="jeonra" data-certificate="1종,3종"></div>
                <div class="post" data-region="jeju" data-certificate="2종"></div>
                <!-- 필요한 게시글 추가 -->
            </div>
        </div>
    </section>

    <script>
        document.getElementById('regionForm').addEventListener('change', function() {
            const selectedRegions = Array.from(document.querySelectorAll('input[name="region"]:checked')).map(checkbox => checkbox.value);
            const selectedCertificates = Array.from(document.querySelectorAll('input[name="certificate"]:checked')).map(checkbox => checkbox.value);
            const posts = document.querySelectorAll('.post');

            posts.forEach(post => {
                const postRegions = post.dataset.region.split(',');
                const postCertificates = post.dataset.certificate.split(',');

                const regionMatch = selectedRegions.length === 0 || selectedRegions.some(region => postRegions.includes(region));
                const certificateMatch = selectedCertificates.length === 0 || selectedCertificates.some(certificate => postCertificates.includes(certificate));

                if (regionMatch && certificateMatch) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        });

        document.getElementById('postForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const selectedRegions = Array.from(document.querySelectorAll('input[name="postRegion"]:checked')).map(checkbox => checkbox.value);
            if (selectedRegions.length === 0) {
                alert('지역을 선택해주세요.'); // 선택된 지역이 없으면 알림 표시
                return; // 폼 제출 중지
            }

            const postTitle = document.getElementById('postTitle').value;
            const postContent = document.getElementById('postContent').value;
            const postRegions = selectedRegions;
            const postCertificates = Array.from(document.querySelectorAll('input[name="postCertificate"]:checked')).map(checkbox => checkbox.value);

            const postDiv = document.createElement('div');
            postDiv.className = 'post';
            postDiv.dataset.region = postRegions.join(',');
            postDiv.dataset.certificate = postCertificates.join(',');
            postDiv.innerHTML = `<h3>${postTitle}</h3><p>${postContent}</p>`;

            document.getElementById('posts').appendChild(postDiv);
            postDiv.style.display = 'block'; // Ensure new post is displayed

            document.getElementById('postForm').reset();

            const eventChange = new Event('change');
            document.getElementById('regionForm').dispatchEvent(eventChange);
        });

        document.getElementById('resetButton').addEventListener('click', function() {
            const posts = document.querySelectorAll('.post');
            posts.forEach(post => {
                post.style.display = 'block';
            });
        });

        // Display all posts initially
        document.addEventListener('DOMContentLoaded', function() {
            const posts = document.querySelectorAll('.post');
            posts.forEach(post => {
                post.style.display = 'block';
            });
        });

    </script>
</body>
</html>
