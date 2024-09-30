<?php
$host = 'postgres';
$db = 'users_db';
$user = 'laravel-getting-started-user';
$pass = 'laravel-getting-started-password';

$conn = pg_connect("host=$host port=5432 dbname=$db user=$user password=$pass");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, array($username, $email, $password));

    if ($result) {
        header("Location: login.html");
        exit();
    } else {
        echo "Помилка: " . pg_last_error();
    }
}

pg_close($conn);
?>