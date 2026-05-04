<?php
require 'config.php';

header('Content-Type: text/html; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $full_name  = trim($_POST['full_name'] ?? '');
    $username   = trim($_POST['username'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $password   = $_POST['password'] ?? '';
    $phone      = trim($_POST['phone'] ?? '');
    $birth_date = $_POST['birth_date'] ?? null;
    $gender     = $_POST['gender'] ?? null;

    if (empty($username) || empty($email) || empty($password)) {
        echo "Username, Email va Parol majburiy!";
        exit;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("
            INSERT INTO users 
            (username, email, password, full_name, phone, birth_date, gender) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([$username, $email, $password_hash, $full_name, $phone, $birth_date, $gender]);

        echo "✅ Muvaffaqiyatli! Ro'yxatdan o'tdingiz.";

    } catch(PDOException $e) {
        echo "XATO: " . $e->getMessage();
    }
} else {
    echo "Noto'g'ri so'rov";
}
?>
