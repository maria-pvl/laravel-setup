<?php

session_start();


if (
    isset($_SESSION["cached_data"]) &&
    isset($_SESSION["cached_time"])
) {

    $age = time() - $_SESSION["cached_time"];


    if ($age < 600) {

        $data = $_SESSION["cached_data"];

        $source = "З кешу сесії";

    } else {

        $data = generateData();

        $_SESSION["cached_data"] = $data;

        $_SESSION["cached_time"] = time();

        $source = "Оновлено кеш";
    }


} else {

    $data = generateData();

    $_SESSION["cached_data"] = $data;

    $_SESSION["cached_time"] = time();

    $source = "Створено новий кеш";
}



function generateData()
{
    sleep(2);


    return array(
        "usd" => rand(35, 40),
        "eur" => rand(38, 43)
    );
}


?>

<!DOCTYPE html>

<html lang="uk">

<head>

    <meta charset="UTF-8">

    <title>Кешування через сесію</title>

</head>

<body>

    <h1>Кешування через сесію</h1>

    <p>
        Дані:
        <?php echo json_encode($data); ?>
    </p>

    <p>
        Джерело:
        <?php echo $source; ?>
    </p>

</body>

</html>