<?php
session_start();

$timeout_duration = 300;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    echo "Сесія завершена через неактивність.";
} else {
    $_SESSION['last_activity'] = time();
    echo "Сесія активна. Остання активність: " . date("H:i:s", $_SESSION['last_activity']);
}
?>
