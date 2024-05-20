<?php
// 세션 시작
session_start();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1대1 질문 게시판</title>
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
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
        .main-content {
            padding: 20px;
            background: #fff;
        }
        .main-content h2 {
            margin-top: 0;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea, button {
            display: block;
            width: 100%;
            margin-top: 5px;
        }
        button {
            width: auto;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        #questionList {
            margin-top: 20px;
        }
        .question-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .question-item h3 {
            margin: 0 0 10px 0;
        }
        .question-item p {
            margin: 0;
        }
        .comment-section {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
        .comment {
            border: 1px solid #eee;
            padding: 5px;
            margin-bottom: 5px;
            border-radius: 5px;
        }
        .comment h4 {
            margin: 0;
        }
        .footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <section class="showcase">
        <div class="container">
            <h1>1대1 질문게시판</h1>
        </div>
    </section>

    <section class="main-content container">
        <form id="questionForm">
            <label for="username">제목:</label>
            <input type="text" id="username" name="username" required>
            <label for="question">질문:</label>
            <textarea id="question" name="question" rows="4" required></textarea>
            <button type="submit">질문 등록</button>
        </form>

        <h2>질문 목록</h2>
        <div id="questionList"></div>
    </section>

    <footer class="footer">
        <p>&copy; 2024 KDEC 한국드론교육센터. 모든 권리 보유.</p>
    </footer>

    <script>
        document.getElementById('questionForm').addEventListener('submit', function(event) {
            event.preventDefault(); // 폼 제출 시 페이지 리로드 방지

            // 입력된 사용자 이름과 질문을 가져오기
            const username = document.getElementById('username').value;
            const question = document.getElementById('question').value;

            // 새로운 질문 아이템 생성
            const questionItem = document.createElement('div');
            questionItem.className = 'question-item';

            const questionHeader = document.createElement('h3');
            questionHeader.textContent = username;

            const questionText = document.createElement('p');
            questionText.textContent = question;

            // 댓글 섹션 생성
            const commentSection = document.createElement('div');
            commentSection.className = 'comment-section';

            // 댓글 입력 폼 생성
            const commentForm = document.createElement('form');
            commentForm.className = 'comment-form';
            const commentNameLabel = document.createElement('label');
            commentNameLabel.textContent = '이름:';
            const commentNameInput = document.createElement('input');
            commentNameInput.type = 'text';
            commentNameInput.required = true;

            const commentLabel = document.createElement('label');
            commentLabel.textContent = '댓글:';
            const commentInput = document.createElement('textarea');
            commentInput.rows = '2';
            commentInput.required = true;

            const commentButton = document.createElement('button');
            commentButton.type = 'submit';
            commentButton.textContent = '댓글 등록';

            commentForm.appendChild(commentNameLabel);
            commentForm.appendChild(commentNameInput);
            commentForm.appendChild(commentLabel);
            commentForm.appendChild(commentInput);
            commentForm.appendChild(commentButton);

            // 댓글 목록 생성
            const commentList = document.createElement('div');
            commentList.className = 'comment-list';

            commentSection.appendChild(commentList);
            commentSection.appendChild(commentForm);

            questionItem.appendChild(questionHeader);
            questionItem.appendChild(questionText);
            questionItem.appendChild(commentSection);

            // 질문 리스트에 추가
            document.getElementById('questionList').appendChild(questionItem);

            // 폼 초기화
            document.getElementById('questionForm').reset();

            // 댓글 폼 이벤트 핸들러 추가
            commentForm.addEventListener('submit', function(event) {
                event.preventDefault(); // 폼 제출 시 페이지 리로드 방지

                // 댓글 입력 내용 가져오기
                const commentName = commentNameInput.value;
                const commentText = commentInput.value;

                // 새로운 댓글 아이템 생성
                const commentItem = document.createElement('div');
                commentItem.className = 'comment';

                const commentHeader = document.createElement('h4');
                commentHeader.textContent = commentName;

                const commentBody = document.createElement('p');
                commentBody.textContent = commentText;

                commentItem.appendChild(commentHeader);
                commentItem.appendChild(commentBody);

                // 댓글 목록에 추가
                commentList.appendChild(commentItem);

                // 댓글 폼 초기화
                commentForm.reset();
            });
        });
    </script>
</body>
</html>
