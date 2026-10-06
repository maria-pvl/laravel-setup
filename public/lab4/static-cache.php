<?php

class ProductCache
{
    private static $cache = null;


    public static function getProducts()
    {

        if (self::$cache !== null) {

            echo "Дані отримані з кешу.<br><br>";

            return self::$cache;
        }


        echo "Дані генеруються...<br><br>";

        sleep(2);


        self::$cache = array(
            "Ноутбук",
            "Телефон",
            "Навушники",
            "Клавіатура",
            "Миша"
        );


        return self::$cache;
    }
}


$products = ProductCache::getProducts();


echo "<h2>Список товарів:</h2>";


foreach ($products as $product) {

    echo $product . "<br>";
}


echo "<br>";

echo "<h2>Повторний виклик:</h2>";


$products = ProductCache::getProducts();


foreach ($products as $product) {

    echo $product . "<br>";
}

?>