<?php

$upload_dir = "uploads/";

if (isset($_FILES["user_file"])) {

    $file = $_FILES["user_file"];

    if (!is_uploaded_file($file["tmp_name"])) {

        echo "Помилка завантаження файлу.";
        exit;

    }

    $file_name = $file["name"];

    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed = array("png", "jpg", "jpeg");

    if (!in_array($extension, $allowed)) {

        echo "Помилка: дозволені тільки PNG, JPG та JPEG.";
        exit;

    }

    if ($file["size"] > 2 * 1024 * 1024) {

        echo "Помилка: розмір файлу не повинен перевищувати 2 МБ.";
        exit;

    }

    if (file_exists($upload_dir . $file_name)) {

        $name = pathinfo($file_name, PATHINFO_FILENAME);

        $file_name = $name . "_" . rand(1000, 9999) . "." . $extension;

    }

    $file_path = $upload_dir . $file_name;

    if (move_uploaded_file($file["tmp_name"], $file_path)) {

        echo "<h1>Файл успішно завантажений!</h1>";

        echo "Ім'я файлу: " . $file_name . "<br><br>";

        echo "Тип файлу: " . $file["type"] . "<br><br>";

        echo "Розмір: " . round($file["size"] / 1024, 2) . " КБ<br><br>";

        echo "<a href='" . $file_path . "' download>";
        echo "Завантажити файл";
        echo "</a>";

    } else {

        echo "Не вдалося зберегти файл.";

    }

} else {

    echo "Файл не обрано.";

}

?>

<br><br>
<a href="index.html">Повернутися назад</a>