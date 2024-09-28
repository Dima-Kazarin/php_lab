<?php
if (isset($_POST['name'])) {
    setcookie("username", $_POST['name'], time() + 7 * 24 * 60 * 60);
    header("Location: cookie_form.php");
    exit;
}

if (isset($_POST['delete_cookie'])) {
    setcookie("username", "", time() - 3600);
    header("Location: cookie_form.php");
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
    <?php if (isset($_COOKIE['username'])): ?>
        <h1>Привіт, <?php echo htmlspecialchars($_COOKIE['username']); ?>!</h1>
        <form method="post">
            <button type="submit" name="delete_cookie">Видалити Cookie</button>
        </form>
    <?php else: ?>
        <form method="post">
            <label for="name">Введіть ваше ім'я:</label>
            <input type="text" name="name" id="name" required>
            <button type="submit">Відправити</button>
        </form>
    <?php endif ?>
</body>
</html>