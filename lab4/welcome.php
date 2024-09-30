<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

echo "Ласкаво просимо, " . $_SESSION['username'] . "!";
?>
