<?php
// Railway environment variables
$host = getenv('MYSQLHOST') ?: getenv('DB_HOST') ?: 'mysql.railway.internal';
$port = getenv('MYSQLPORT') ?: '3306';
$db   = getenv('MYSQLDATABASE') ?: getenv('DB_NAME') ?: 'railway';
$user = getenv('MYSQLUSER') ?: getenv('DB_USER') ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: getenv('DB_PASS') ?: 'BWHOveAWkOVkfNLccoGQBKCeFoShJuXf';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Ulanish muvaffaqiyatli"; // test uchun
} catch(PDOException $e) {
    die("DB Ulanish Xatosi: " . $e->getMessage());
}
?>
