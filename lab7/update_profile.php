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

if (!isset($_SESSION['user'])) {
    echo "Будь ласка, увійдіть у свій акаунт.";
    exit;
}

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$currentUser = $_SESSION['user'];

$query = "UPDATE users SET username = $1, password = $2 WHERE username = $3";
$result = pg_query_params($conn, $query, array($username, $password, $currentUser));

if ($result) {
    $_SESSION['user'] = $username;
    echo "Профіль успішно оновлено!";
} else {
    echo "Помилка при оновленні профілю.";
}
?>
