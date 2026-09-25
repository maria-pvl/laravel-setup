<?php

session_start();

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}


if (isset($_POST["product"])) {

    $product = $_POST["product"];

    $_SESSION["cart"][] = $product;

    header("Location: task4.php");
    exit;
}


if (isset($_POST["clear"])) {

    $_SESSION["cart"] = array();

    header("Location: task4.php");
    exit;
}


if (isset($_POST["buy"])) {

    if (count($_SESSION["cart"]) > 0) {

        if (isset($_COOKIE["previous"])) {
            $previous = $_COOKIE["previous"];
        } else {
            $previous = "";
        }

        foreach ($_SESSION["cart"] as $product) {

            if ($previous != "") {
                $previous = $previous . ", ";
            }

            $previous = $previous . $product;
        }

        setcookie(
            "previous",
            $previous,
            time() + 30 * 24 * 60 * 60
        );

        $_SESSION["cart"] = array();
    }

    header("Location: task4.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Корзина</title>
</head>

<body>

    <h1>Корзина покупок</h1>


    <h2>Додати товар:</h2>

    <form method="post">

        <button type="submit" name="product" value="Кава">
            Кава
        </button>

        <button type="submit" name="product" value="Торт">
            Торт
        </button>

        <button type="submit" name="product" value="Чай">
            Чай
        </button>

        <button type="submit" name="product" value="Кулька">
            Кулька
        </button>

    </form>


    <h2>Поточна корзина:</h2>

    <?php

    if (count($_SESSION["cart"]) > 0) {

        foreach ($_SESSION["cart"] as $product) {
            echo $product . "<br>";
        }

    } else {

        echo "Корзина порожня.";

    }

    ?>


    <br>

    <form method="post">

        <button type="submit" name="buy">
            Завершити покупку
        </button>

        <button type="submit" name="clear">
            Очистити корзину
        </button>

    </form>


    <h2>Попередні покупки:</h2>

    <?php

    if (isset($_COOKIE["previous"])) {

        echo $_COOKIE["previous"];

    } else {

        echo "Попередніх покупок немає.";

    }

    ?>

</body>

</html>