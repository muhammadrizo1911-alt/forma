<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $full_name     = trim($_POST['full_name'] ?? '');
    $username      = trim($_POST['username'] ?? '');
    $email         = trim($_POST['email'] ?? '');
    $password      = $_POST['password'] ?? '';
    $phone         = trim($_POST['phone'] ?? '');
    $birth_date    = $_POST['birth_date'] ?? null;
    $gender        = $_POST['gender'] ?? null;

    if (empty($username) || empty($email) || empty($password)) {
        die("<h2 style='color:red;text-align:center;'>Username, Email va Parol majburiy!</h2>");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("
            INSERT INTO users 
            (username, email, password, full_name, phone, birth_date, gender) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([$username, $email, $password_hash, $full_name, $phone, $birth_date, $gender]);

        echo "<h2 style='color:green;text-align:center;'>✅ Ro'yxatdan o'tish muvaffaqiyatli!</h2>";
        echo "<p style='text-align:center;'><a href='index.html'>← Orqaga</a></p>";

    } catch(PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "<h2 style='color:red;text-align:center;'>Bu username yoki email allaqachon mavjud!</h2>";
        } else {
            echo "<h2>Xatolik: " . htmlspecialchars($e->getMessage()) . "</h2>";
        }
    }
} else {
    header("Location: index.html");
    exit;
}
?>