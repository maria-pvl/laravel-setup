<?php

$host = "postgres";
$port = "5432";
$dbname = getenv("POSTGRES_DB");
$username = getenv("POSTGRES_USER");
$password = getenv("POSTGRES_PASSWORD");

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Помилка підключення до бази даних.");
}