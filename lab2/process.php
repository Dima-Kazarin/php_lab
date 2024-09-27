<?php
$uploadDir = 'uploads/';
$maxFileSize = 2 * 1024 * 1024;
$allowedTypes = ['image/png', 'image/jpg', 'image/jpeg'];

if (isset($_FILES['uploadedFile'])) {
    $file = $_FILES['uploadedFile'];

    if (is_uploaded_file($file['tmp_name'])) {

        if (in_array($file['type'], $allowedTypes)) {

            if ($file['size'] <= $maxFileSize) {

                $fileName = basename($file['name']);
                $targetFilePath = $uploadDir . $fileName;

                if (file_exists($targetFilePath)) {
                    $fileName = time() . "_" . $fileName;
                    $targetFilePath = $uploadDir . $fileName;
                }

                if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                    echo "Файл успішно завантажено!<br>";
                    echo "Ім'я файлу: $fileName<br>";
                    echo "Тип файлу: {$file['type']}<br>";
                    echo "Розмір файлу: " . round($file['size'] / 1024, 2) . " КБ<br>";
                    echo "<a href='$targetFilePath'>Завантажити файл</a>";
                } else {
                    echo "Помилка при завантаженні файлу.";
                }

            } else {
                echo "Файл занадто великий. Максимальний розмір - 2 МБ.";
            }

        } else {
            echo "Дозволено завантажувати лише файли типу PNG, JPG, JPEG.";
        }

    } else {
        echo "Помилка при завантаженні файлу.";
    }
}
?>