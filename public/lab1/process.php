<?php

$name = $_POST["name"];
$surname = $_POST["surname"];

if (empty($name) || empty($surname)) {
    echo "Будь ласка, заповніть обидва поля.";

} elseif (is_numeric($name) || is_numeric($surname)) {
    echo "Помилка: дані повинні бути текстом.";

} else {
    echo "Привіт, " . $name . " " . $surname . "!";
}
?>