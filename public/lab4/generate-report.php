<?php

$cache_file = "cache/report.html";

$cache_time = 10 * 60;


if (file_exists($cache_file)) {

    $file_time = filemtime($cache_file);

    $age = time() - $file_time;


    if ($age < $cache_time) {

        echo "<h1>Звіт із кешу</h1>";

        echo file_get_contents($cache_file);

        exit;
    }
}


echo "<h1>Генерація нового звіту...</h1>";


sleep(3);


$html = "<table border='1'>";

$html .= "<tr>";
$html .= "<th>Ім'я</th>";
$html .= "<th>Сума</th>";
$html .= "<th>Дата</th>";
$html .= "</tr>";


for ($i = 1; $i <= 1000; $i++) {

    $name = "Користувач " . $i;

    $sum = rand(100, 10000);

    $date = date("d.m.Y");


    $html .= "<tr>";

    $html .= "<td>" . $name . "</td>";

    $html .= "<td>" . $sum . " грн</td>";

    $html .= "<td>" . $date . "</td>";

    $html .= "</tr>";
}


$html .= "</table>";


file_put_contents($cache_file, $html);

echo $html;

?>