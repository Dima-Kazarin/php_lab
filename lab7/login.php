<?php
session_start();

$host = 'postgres';
$db = 'users_db';
$user = 'laravel-getting-started-user';
$pass = 'laravel-getting-started-password';

$conn = pg_connect("host=$host dbname=$db user=$user password=$pass");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = $1";
$result = pg_query_params($conn, $query, array($email));

if ($user = pg_fetch_assoc($result)) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        echo "Вхід успішний!";
    } else {
        echo "Невірний логін або пароль.";
    }
} else {
    echo "Невірний логін або пароль.";
}
?>
