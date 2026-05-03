<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma'lumot Qo'shish</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Ism va Telefon raqam qo'shish</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ism = trim($_POST['ism']);
        $telefon = trim($_POST['telefon']);

        if (!empty($ism) && !empty($telefon)) {
            $sql = "INSERT INTO contacts (ism, telefon) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $ism, $telefon);
            
            if ($stmt->execute()) {
                echo "<p class='success'>✅ Muvaffaqiyatli saqlandi!</p>";
            } else {
                echo "<p class='error'>Xato: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p class='error'>Barcha maydonlarni to'ldiring!</p>";
        }
    }
    ?>

    <form method="POST">
        <input type="text" name="ism" placeholder="Ismingiz" required>
        <input type="text" name="telefon" placeholder="+998 XX XXX XX XX" required>
        <button type="submit">Saqlash</button>
    </form>
</div>

</body>
</html>
