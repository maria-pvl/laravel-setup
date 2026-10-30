<?php
session_start();
?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Авторизація</title>
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
        <p>Система реєстрації та авторизації користувачів</p>

        <?php if (isset($_SESSION["user_id"])): ?>
            <p>Ви вже авторизовані.</p>
            <a href="welcome.php">Мій профіль</a>
            <a href="logout.php">Вийти</a>
        <?php else: ?>
            <a href="register.php">Реєстрація</a>
            <a href="login.php">Авторизація</a>
        <?php endif; ?>
    </div>

</body>

</html>