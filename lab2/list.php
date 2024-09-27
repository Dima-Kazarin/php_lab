<?php
$uploadDir = 'uploads/';

if (is_dir($uploadDir)) {
    $files = scandir($uploadDir);

    echo "<h2>Список файлів:</h2>";
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            echo "<a href='$uploadDir/$file'>$file</a><br>";
        }
    } 
} else {
        echo "Директорія не знайдена.";
}
?>