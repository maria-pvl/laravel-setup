<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: task3.php");
    exit;

}

?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Інформація</title>
</head>

<body>

    <h1>Інформація про запит</h1>

    <?php

    echo "IP-адреса клієнта: ";
    echo $_SERVER["REMOTE_ADDR"];

    echo "<br><br>";

    echo "Браузер: ";
    echo $_SERVER["HTTP_USER_AGENT"];

    echo "<br><br>";

    echo "Назва скрипта: ";
    echo $_SERVER["PHP_SELF"];

    echo "<br><br>";

    echo "Метод запиту: ";
    echo $_SERVER["REQUEST_METHOD"];

    echo "<br><br>";

    echo "Шлях до файлу: ";
    echo $_SERVER["SCRIPT_FILENAME"];

    ?>

</body>

</html>