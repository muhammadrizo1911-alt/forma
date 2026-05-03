<?php
$servername = "localhost";
$username   = "root";
$password   = "SIZNING_PAROLINGIZ";   // ← O'zingizning parolni yozing
$dbname     = "minifood";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ulanishda xato: " . $conn->connect_error);
}
?>
