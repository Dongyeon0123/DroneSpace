<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>구인 게시판</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
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
        .main-content textarea {
            height: 200px;
        }
        .region-selection fieldset,
        .region-selection fieldset label {
            width: 100%;
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
            background-color: #4CAF50;
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
            background-color: #366e39;
        }
        label {
            display: inline-block;
            margin-right: 10px;
        }
        input[type="checkbox"]:checked + label {
            font-weight: bold;
        }
        .inline-fieldset {
            display: inline-block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>구인 게시판</h1>
            </div>
        </div>
    </header>
    <section class="main-content container">
        <div class="post-creation">
            <h2>게시글 작성</h2>
            <form id="postForm">
                <fieldset>
                    <legend>지역 선택</legend>
                    <input type="checkbox" name="postRegion" value="seoul"> 서울
                    <input type="checkbox" name="postRegion" value="gyeonggi"> 경기/인천
                    <input type="checkbox" name="postRegion" value="gangwon"> 강원도
                    <input type="checkbox" name="postRegion" value="chungcheong"> 충청도
                    <input type="checkbox" name="postRegion" value="gyeonsang"> 경상도
                    <input type="checkbox" name="postRegion" value="jeonra"> 전라도
                    <input type="checkbox" name="postRegion" value="jeju"> 제주
                </fieldset>
                <fieldset>
                    <legend>자격증 선택</legend>
                    <input type="checkbox" name="postCertificate" value="1종"> 1종
                    <input type="checkbox" name="postCertificate" value="2종"> 2종
                    <input type="checkbox" name="postCertificate" value="3종"> 3종
                </fieldset>
                <label for="postTitle">제목</label>
                <input type="text" id="postTitle" name="postTitle" required>
                <label for="postContent">내용</label>
                <textarea id="postContent" name="postContent" placeholder="ex)기업명:
근무 지역:
근무 시간:
우대 자격증 조건:
구인자:
연락처: " required></textarea>
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
                    <input type="checkbox" name="region" value="seoul"> 서울
                    <input type="checkbox" name="region" value="gyeonggi"> 경기/인천
                    <input type="checkbox" name="region" value="gangwon"> 강원도
                    <input type="checkbox" name="region" value="chungcheong"> 충청도
                    <input type="checkbox" name="region" value="gyeonsang"> 경상도
                    <input type="checkbox" name="region" value="jeonra"> 전라도
                    <input type="checkbox" name="region" value="jeju"> 제주
                </fieldset>
                <fieldset>
                    <legend>자격증 선택</legend>
                    <input type="checkbox" name="certificate" value="1종"> 1종
                    <input type="checkbox" name="certificate" value="2종"> 2종
                    <input type="checkbox" name="certificate" value="3종"> 3종
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" id="resetButton">리셋</button>
                </fieldset>
            </form>
        </div>

        <div class="posts-list">
            <h2>게시글 목록</h2>
            <table id="postsTable">
                <thead>
                    <tr>
                        <th>제목</th>
                        <th>게시한 날짜</th>
                        <th>지원</th>
                        <th>삭제</th>
                    </tr>
                </thead>
                <tbody id="posts">
                    <!-- 게시글이 동적으로 추가됩니다. -->
                </tbody>
            </table>
        </div>
    </section>

    <script>
        function filterPosts() {
            const selectedRegions = Array.from(document.querySelectorAll('input[name="region"]:checked')).map(checkbox => checkbox.value);
            const selectedCertificates = Array.from(document.querySelectorAll('input[name="certificate"]:checked')).map(checkbox => checkbox.value);
            const posts = document.querySelectorAll('.post');

            posts.forEach(post => {
                const postRegions = post.dataset.region.split(',');
                const postCertificates = post.dataset.certificate.split(',');

                const regionMatch = selectedRegions.length === 0 || selectedRegions.some(region => postRegions.includes(region));
                const certificateMatch = selectedCertificates.length === 0 || selectedCertificates.some(certificate => postCertificates.includes(certificate));

                if (regionMatch && certificateMatch) {
                    post.classList.remove('hidden');
                } else {
                    post.classList.add('hidden');
                }
            });
        }

        document.getElementById('regionForm').addEventListener('change', filterPosts);

        document.getElementById('postForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const selectedRegions = Array.from(document.querySelectorAll('input[name="postRegion"]:checked')).map(checkbox => checkbox.value);
            if (selectedRegions.length === 0) {
                alert('지역을 선택해주세요.');
                return;
            }

            const postTitle = document.getElementById('postTitle').value;
            const postContent = document.getElementById('postContent').value;
            const postRegions = selectedRegions;
            const postCertificates = Array.from(document.querySelectorAll('input[name="postCertificate"]:checked')).map(checkbox => checkbox.value);
            const postDate = new Date().toISOString().split('T')[0];

            const postRow = document.createElement('tr');
            postRow.className = 'post';
            postRow.dataset.region = postRegions.join(',');
            postRow.dataset.certificate = postCertificates.join(',');
            postRow.dataset.content = postContent; // 저장된 게시글 내용을 data-content 속성에 추가
            postRow.innerHTML = `<td><a href="#" class="postTitleLink">${postTitle}</a></td><td>${postDate}</td><td><button class="applyButton">지원하기</button></td><td><button class="deleteButton">삭제</button></td>`;

            const postsTable = document.getElementById('posts');
            postsTable.insertBefore(postRow, postsTable.firstChild);

            postRow.classList.remove('hidden');

            document.getElementById('postForm').reset();

            filterPosts();
        });

        document.getElementById('resetButton').addEventListener('click', function() {
            const posts = document.querySelectorAll('.post');
            posts.forEach(post => {
                post.classList.remove('hidden');
            });
        });

        document.getElementById('posts').addEventListener('click', function(event) {
            if (event.target.classList.contains('applyButton')) {
                window.open("submithire.php", "popup", "width=600,height=800");
            }
        });

        document.getElementById('posts').addEventListener('click', function(event) {
            if (event.target.classList.contains('deleteButton')) {
                event.target.closest('tr').remove();
                filterPosts();
            }
        });

        // 게시글 제목 링크 클릭 시 해당 게시글의 내용을 새 창에서 보기 좋게 표시
        document.getElementById('posts').addEventListener('click', function(event) {
            if (event.target.classList.contains('postTitleLink')) {
                event.preventDefault();
                const postContent = event.target.closest('tr').dataset.content; // 저장된 게시글 내용을 가져옴
                const postTitle = event.target.innerText;
                const postDate = event.target.closest('tr').querySelector('td:nth-child(2)').innerText;

                const postWindow = window.open("", "postWindow", "width=600,height=400");
                postWindow.document.write(`
                    <html>
                        <head>
                            <title>${postTitle}</title>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    margin: 0;
                                    padding: 20px;
                                    background-color: #f4f4f4;
                                }
                                .post-container {
                                    background: #fff;
                                    padding: 20px;
                                    border-radius: 8px;
                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                }
                                h1 {
                                    border-bottom: 2px solid #ddd;
                                    padding-bottom: 10px;
                                }
                                p {
                                    white-space: pre-wrap; /* 줄바꿈을 유지 */
                                }
                                .post-date {
                                    color: #777;
                                    font-size: 0.9em;
                                }
                                .close-button {
                                    display: block;
                                    margin: 20px 0 0;
                                    padding: 10px 20px;
                                    background-color: #4CAF50;
                                    color: white;
                                    text-align: center;
                                    border: none;
                                    border-radius: 5px;
                                    font-size: 16px;
                                    cursor: pointer;
                                }
                                .close-button:hover {
                                    background-color: #45a049;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="post-container">
                                <h1>${postTitle}</h1>
                                <p>${postContent}</p>
                                <p class="post-date">게시한 날짜: ${postDate}</p>
                                <button class="close-button" onclick="window.close()">닫기</button>
                            </div>
                        </body>
                    </html>
                `);
                postWindow.document.close();
            }
        });

        document.addEventListener('DOMContentLoaded', filterPosts);
    </script>
</body>
</html>
