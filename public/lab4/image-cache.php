<?php

$file = "images/test.jpg";

header("Content-Type: image/jpeg");

header("Cache-Control: public, max-age=86400");

header(
    "Expires: " .
    gmdate("D, d M Y H:i:s", time() + 86400) .
    " GMT"
);

readfile($file);

?>