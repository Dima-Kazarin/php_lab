<?php
header('Content-Type: application/json');

$host = 'postgres';
$db = 'users_db';
$user = 'laravel-getting-started-user';
$pass = 'laravel-getting-started-password';

$conn = pg_connect("host=$host dbname=$db user=$user password=$pass");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data['order_number']) && !empty($data['weight']) && !empty($data['city']) && !empty($data['delivery_type']) && !empty($data['branch_locker'])) {
    $orderNumber = $data['order_number'];
    $weight = $data['weight'];
    $city = $data['city'];
    $deliveryType = $data['delivery_type'];
    $branchLocker = $data['branch_locker'];

    $query = "INSERT INTO orders (order_number, weight, city, delivery_type, branch_locker) VALUES ($1, $2, $3, $4, $5)";
    $result = pg_query_params($conn, $query, [$orderNumber, $weight, $city, $deliveryType, $branchLocker]);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Помилка при збереженні даних']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Неповні дані']);
}

pg_close($conn);
?>
