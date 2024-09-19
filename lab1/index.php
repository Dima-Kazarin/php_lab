<?php
// 1
echo "Hello, World! <br>";

// 2
$stringVar = "string";
$intVar = 2;
$floatVar = 3.14;
$boolVar = true;

echo "$stringVar <br>";
echo "$intVar <br>";
echo "$floatVar <br>";
echo "$boolVar <br>";

var_dump($stringVar);
var_dump($intVar);
var_dump($floatVar);
var_dump($boolVar);

// 3
$firstWord = "Hello";
$secondWord = "World ";
$concateWord = $firstWord . " " . $secondWord;
echo "$concateWord <br>";

// 4
$number = 3;
if($number % 2 == 0) {
    echo "number $number is even <br>";
}else {
    echo "number $number is odd <br>";
}

// 5
for($i = 1; $i <= 10; $i++) {
    echo " $i <br>";
}

$num = 10;
while($num >= 1) {
    echo " $num <br>";
    $num--;
}

// 6
$student = array(
    "name" => "Dima",
    "surname" => "Kazarin",
    "age" => 19,
    "speciality" => "Programming");
print_r($student);

$student["average_grade"] = 4.5;
print_r($student);
?>
