<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['item'])) {
    $_SESSION['cart'][] = $_POST['item'];
}

$previous_cart = [];
if (isset($_COOKIE['previous_cart'])) {
    $previous_cart = json_decode($_COOKIE['previous_cart'], true);
}

$combined_cart = array_unique(array_merge($previous_cart, $_SESSION['cart']));
setcookie('previous_cart', json_encode($combined_cart), time() + 7 * 24 * 60 * 60);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Корзина покупок</h1>

    <form method="post">
        <label for="item">Додати товар:</label>
        <input type="text" id="item" name="item" required>
        <button type="submit">Додати</button>
    </form>

    <h2>Поточні товари в корзині:</h2>
    <ul>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <li><?php echo htmlspecialchars($item); ?></li>
        <?php endforeach; ?>
    </ul>

    <?php if (isset($previous_cart)): ?>
        <h2>Попередні покупки:</h2>
        <ul>
            <?php foreach ($previous_cart as $item): ?>
                <li><?php echo htmlspecialchars($item); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>