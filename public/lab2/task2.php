<?php

session_start();

if (isset($_POST["login"])) {

    $login = $_POST["login_name"];
    $password = $_POST["password"];

    if ($login == "admin" && $password == "1234") {

        $_SESSION["user"] = $login;

    } else {

        $error = "Неправильный логин или пароль.";

    }
}


if (isset($_POST["logout"])) {

    session_unset();
    session_destroy();

    header("Location: task2.php");
    exit;

}

?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Session</title>
</head>

<body>

    <h1>Робота з Session</h1>

    <?php

    if (isset($_SESSION["user"])) {

        echo "Привіт, " . $_SESSION["user"] . "!";

        ?>

        <br><br>

        <form method="post">

            <button type="submit" name="logout">
                Вихід
            </button>

        </form>

        <?php

    } else {

        if (isset($error)) {

            echo $error;
            echo "<br><br>";

        }

        ?>

        <form method="post">

            Логін:
            <br>

            <input type="text" name="login_name">

            <br><br>

            Пароль:
            <br>

            <input type="password" name="password">

            <br><br>

            <button type="submit" name="login">
                Увійти
            </button>

        </form>

        <?php

    }

    ?>

</body>

</html>