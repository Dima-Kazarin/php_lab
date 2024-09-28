<?php 
session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: session_login.php");
    exit;
}

if (isset($_SESSION['username'])) {
    echo "<h1>Привіт, " . htmlspecialchars($_SESSION['username']) . "!</h1>";
    echo '<form method="post"><button type="submit" name="logout">Вихід</button></form>';
} else {
    if (isset($_POST['username']) && isset($_POST['password'])) {

        if ($_POST['username'] === 'user' && $_POST['password'] === 'pass') {
            $_SESSION['username'] = $_POST['username'];
            header("Location: session_login.php");
            exit;
        } else {
            echo "Невірний логін або пароль!";
        }
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
    <form method="post">
        <label for="username">Логін:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Вхід</button>
    </form>
</body>
</html>

<?php } ?>