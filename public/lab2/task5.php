<?php

session_start();

$timeout = 5 * 60;

$sessionEnded = false;


if (isset($_SESSION["last_activity"])) {

    if (time() - $_SESSION["last_activity"] > $timeout) {

        // Завершаем старую сессию
        session_unset();
        session_destroy();

        // Начинаем новую сессию
        session_start();

        $sessionEnded = true;
    }
}

$_SESSION["last_activity"] = time();

?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Час сесії</title>
</head>

<body>

    <h1>Контроль активності сесії</h1>


    <?php

    if ($sessionEnded) {

        echo "<h2>Сесію завершено!</h2>";

        echo "<p>";
        echo "Ви не виконували дій більше 5 хвилин.";
        echo "</p>";

        echo "<p>";
        echo "Сесію було автоматично завершено.";
        echo "</p>";

    } else {

        echo "<h2>Сесія активна</h2>";

        echo "<p>";
        echo "Сесія буде завершена після 5 хвилин бездіяльності.";
        echo "</p>";

    }

    ?>


    <p>
        Остання активність:
        <?php
        echo date("H:i:s", $_SESSION["last_activity"]);
        ?>
    </p>


</body>

</html>