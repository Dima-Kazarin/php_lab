<?php
if (isset($_POST['logText'])) {
    $text = $_POST['logText'];
    $file = 'log.txt';

    file_put_contents($file, $text . PHP_EOL, FILE_APPEND | LOCK_EX);
    echo "Текст успішно записано у файл.<br>";

    $contents = file_get_contents($file);
    echo "<h1>$contents</h1>";
}
?>