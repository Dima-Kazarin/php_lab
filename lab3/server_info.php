<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: session_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>IP-адреса клієнта: <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
    <p>Назва браузера: <?php echo $_SERVER['HTTP_USER_AGENT']; ?></p>
    <p>Назва скрипта: <?php echo $_SERVER['PHP_SELF']; ?></p>
    <p>Метод запиту: <?php echo $_SERVER['REQUEST_METHOD']; ?></p>
    <p>Шлях до файлу: <?php echo $_SERVER['SCRIPT_FILENAME']; ?></p>
</body>
</html>