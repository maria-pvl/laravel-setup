<?php

if (isset($_POST["save"])) {

    $name = $_POST["name"];

    setcookie("name", $name, time() + 7 * 24 * 60 * 60);

    header("Location: task1.php");
    exit;
}


if (isset($_POST["delete"])) {

    setcookie("name", "", time() - 3600);

    header("Location: task1.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Cookie</title>
</head>

<body>

    <h1>Робота з Cookie</h1>

    <?php

    if (isset($_COOKIE["name"])) {

        echo "Привіт, " . $_COOKIE["name"] . "!";

    } else {

        echo "Введіть своє ім'я.";

    }

    ?>

    <br><br>

    <form method="post">

        <input type="text" name="name" placeholder="Ваше ім'я">

        <br><br>

        <button type="submit" name="save">
            Зберегти ім'я
        </button>

    </form>

    <br>

    <form method="post">

        <button type="submit" name="delete">
            Видалити cookie
        </button>

    </form>

</body>

</html>