<?php
if (!empty($_POST["firstName"]) && !empty($_POST["lastName"])) {
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    
    echo "Hello, " . $firstName . " " . $lastName . "!";
} else {
    echo "Please, fill in all fields"; 
}
?>
