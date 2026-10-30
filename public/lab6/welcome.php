<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Особистий кабінет</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f3f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 35px;
            border-radius: 12px;
            text-align: center;
            width: 320px;
            box-shadow: 0 4px 15px #0001;
        }

        a {
            display: block;
            background: #343a40;
            color: white;
            text-decoration: none;
            padding: 12px;
            margin-top: 12px;
            border-radius: 6px;
        }

        a:hover {
            background: #495057;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Вітаємо!</h1>

        <p>Ви успішно увійшли в систему,
            <?= htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8') ?>!
        </p>

        <a href="logout.php">Вийти з акаунта</a>
    </div>

</body>

</html>