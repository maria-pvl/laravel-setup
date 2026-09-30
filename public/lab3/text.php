<?php

$file = "log.txt";

if (isset($_POST["text"])) {

    $text = $_POST["text"];

    if ($text != "") {

        file_put_contents($file, $text . PHP_EOL, FILE_APPEND);

        echo "Текст успішно записаний у файл.<br><br>";

    } else {

        echo "Введіть текст.<br><br>";

    }
}

?>

<h1>Вміст log.txt</h1>

<?php

if (file_exists($file)) {

    $content = file_get_contents($file);

    echo nl2br(htmlspecialchars($content));

} else {

    echo "Файл log.txt ще не створений.";

}

?>

<br><br>
<a href="index.html">Повернутися назад</a>