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

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "SELECT * FROM users WHERE email = $1";
$result = pg_query_params($conn, $query, array($email));

if (pg_num_rows($result) > 0) {
    echo "Ця електронна пошта вже зареєстрована.";
} else {
    $query = "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, array($username, $email, $password));
    
    if ($result) {
        echo "Реєстрація пройшла успішно!";
    } else {
        echo "Помилка при реєстрації.";
    }
}
?>
