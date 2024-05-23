<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>이력서 작성</title>
    <link rel="stylesheet" href="styles.css"> <!-- 스타일 시트 링크 -->
    <style>
        /* 전체 페이지 스타일링 */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        /* 폼 스타일링 */
        form {
            background-color: white;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        div {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="tel"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* padding을 포함한 너비를 100%로 계산 */
            margin-bottom: 10px;
        }

        textarea {
            height: 100px;
            resize: vertical; /* 사용자가 세로 크기 조절 가능 */
        }

        button {
            background-color: #5C67F2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #4a54e1; /* 버튼 호버 효과 */
        }

        /* 경력 추가 버튼 스타일 */
        #experience-container button {
            margin-top: 10px;
            background-color: #4CAF50;
        }

        #experience-container div {
            background-color: #e7e7e7;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
        }

        /* 삭제 버튼 스타일 */
        .delete-button {
            background-color: #FF4B4B;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .delete-button:hover {
            background-color: #D43F3F; /* 삭제 버튼 호버 효과 */
        }
    </style>
</head>
<body>
    <h1>이력서 작성</h1>
    <form action="submit_resume.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="name">이름:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="birthdate">생년월일:</label>
            <input type="date" id="birthdate" name="birthdate" required>
        </div>
        <div>
            <label for="phone">연락처:</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        <div>
            <label for="address">주소:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div>
            <label for="education">학력:</label>
            <select id="education" name="education" onchange="toggleUniversityField()">
                <option value="highschool">고졸</option>
                <option value="college">2,3년제 대학 재학</option>
                <option value="university">4년제 대학 재학</option>
                <option value="college_graduated">2,3년제 대학 졸업</option>
                <option value="university_graduated">4년제 대학 졸업</option>
            </select>
        </div>
        <div id="university-field" style="display:none;">
            <label for="university_name">대학교명:</label>
            <input type="text" id="university_name" name="university_name">
        </div>
        <div>
            <label for="certifications">자격증 보유 현황:</label>
            <input type="checkbox" name="certifications[]" value="1종 드론 국가자격증"> 1종 드론 국가자격증<br>
            <input type="checkbox" name="certifications[]" value="2종 드론 국가자격증"> 2종 드론 국가자격증<br>
            <input type="checkbox" name="certifications[]" value="3종 드론 국가자격증"> 3종 드론 국가자격증<br>
            <input type="checkbox" name="certifications[]" value="4종 드론 국가자격증"> 4종 드론 국가자격증<br>
            <input type="checkbox" name="certifications[]" value="초경량 비행장치 조종 자격증"> 초경량 비행장치 조종 자격증<br>
            <input type="checkbox" name="certifications[]" value="드론교관자격증"> 드론교관자격증<br>
            <input type="checkbox" name="certifications[]" value="드론 실기평가 조종자 자격증"> 드론 실기평가 조종자 자격증<br>
        </div>
        <div id="experience-container">
            <label for="experience">경력:</label>
            <button type="button" onclick="addExperience()">경력 추가</button>
        </div>
        <div>
            <label for="resume_photo">이력서 사진:</label>
            <input type="file" id="resume_photo" name="resume_photo" accept="image/*">
        </div>
        <button type="submit">제출</button>
    </form>

    <script>
        function addExperience() {
            const container = document.getElementById('experience-container');
            const newExp = document.createElement('div');
            newExp.innerHTML = `
                <input type="text" placeholder="회사명" name="company[]">
                <input type="text" placeholder="근무 기간(N년)" name="period[]">
                <input type="text" placeholder="담당 업무" name="duties[]">
                <button type="button" class="delete-button" onclick="removeExperience(this)">삭제</button>
            `;
            container.appendChild(newExp);
        }

        function removeExperience(button) {
            const expDiv = button.parentNode;
            expDiv.parentNode.removeChild(expDiv);
        }

        function toggleUniversityField() {
            const educationSelect = document.getElementById('education');
            const universityField = document.getElementById('university-field');
            if (educationSelect.value === 'college' || educationSelect.value === 'university') {
                universityField.style.display = 'block';
            } else {
                universityField.style.display = 'none';
            }
        }
    </script>
</body>
</html>
