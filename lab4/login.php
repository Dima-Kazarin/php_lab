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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = $1";
    $result = pg_query_params($conn, $query, array($username));

    if ($row = pg_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
        } else {
            echo "Невірний пароль!";
        }
    } else {
        echo "Користувача не знайдено!";
    }
}

pg_close($conn);
?>