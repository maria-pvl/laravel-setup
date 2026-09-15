<?php

//завдання 1, базовий скрипт
// Виводимо текст на екран.
echo "Hello, World!";


//завдання 2, змінні та типи даних
$name = "Марія";

$age = 19;

$average = 90.5;

$isStudent = TRUE;

echo "<br>";
echo $name;

echo "<br>";
echo $age;

echo "<br>";
echo $average;

echo "<br>";
echo $isStudent;

echo "<br><br>";

var_dump($name);

echo "<br>";
var_dump($age);

echo "<br>";
var_dump($average);

echo "<br>";
var_dump($isStudent);


//завдання 3, конкатенація рядків
$firstName = "Марія ";
$lastName = "Павлова";

$fullName = $firstName . $lastName;

echo "<br><br>";
echo $fullName;


//завдання 4, умовні конструкції
$number = 8;

if ($number % 2 == 0) {

    echo "<br><br>";
    echo "Число $number є парним.";
} else {

    echo "<br><br>";
    echo "Число $number є непарним.";
}


//завдання 5, цикли
//числа від 1 до 10 за допомогою for.
echo "<br><br>";
echo "Числа від 1 до 10:<br>";

for ($i = 1; $i <= 10; $i++) {

    echo $i . " ";
}

//числа від 10 до 1 за допомогою while.
echo "<br><br>";
echo "Числа від 10 до 1:<br>";

$i = 10;

while ($i >= 1) {

    echo $i . " ";

    $i--;
}


//завдання 6, асоціативний масив
$student = array(

    "name" => "Марія",
    "surname" => "Павлова",
    "age" => 19,
    "specialty" => "Комп'ютерні науки"
);

echo "<br><br>";

echo "Ім'я: " . $student["name"] . "<br>";

echo "Прізвище: " . $student["surname"] . "<br>";

echo "Вік: " . $student["age"] . "<br>";

echo "Спеціальність: " . $student["specialty"] . "<br>";

$student["average"] = 90.5;

echo "<br>";
echo "Оновлений масив:<br>";

print_r($student);
?>