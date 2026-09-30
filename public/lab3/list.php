<?php

$upload_dir = "uploads/";

?>

<h1>Список файлів</h1>

<?php

$dir = opendir($upload_dir);

if ($dir) {

    while (($file = readdir($dir)) !== false) {

        if ($file != "." && $file != "..") {

            echo "<a href='" . $upload_dir . $file . "' download>";
            echo $file;
            echo "</a>";

            echo "<br><br>";
        }
    }

    closedir($dir);

} else {

    echo "Не вдалося відкрити папку uploads.";

}

?>

<br>
<a href="index.html">Повернутися назад</a>