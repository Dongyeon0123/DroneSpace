<?php
$adminPasswords = ['skso1951', 'dlatmddnjs', 'qkdtmdwo'];
$hashedPasswords = [];

foreach ($adminPasswords as $adminPassword) {
    $hashedPasswords[] = password_hash($adminPassword, PASSWORD_DEFAULT);
}

// 출력하여 확인
foreach ($hashedPasswords as $index => $hashedPassword) {
    echo "Admin " . ($index + 1) . " hashed password: " . $hashedPassword . "<br>";
}

// 이 해시된 비밀번호들을 데이터베이스에 저장해야 합니다.
?>
