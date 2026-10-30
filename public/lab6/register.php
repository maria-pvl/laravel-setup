<?php
session_start();
require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($username === "" || $email === "" || $password === "") {
        $message = "Заповніть усі поля.";
    } elseif (strlen($username) > 255 || strlen($email) > 255) {
        $message = "Занадто довгі дані.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Введіть правильну електронну пошту.";
    } elseif (strlen($password) < 6) {
        $message = "Пароль повинен містити щонайменше 6 символів.";
    } else {
        $check = $pdo->prepare(
            "SELECT id FROM users WHERE name = :username OR email = :email"
        );

        $check->execute([
            "username" => $username,
            "email" => $email
        ]);

        if ($check->fetch()) {
            $message = "Користувач із таким логіном або email вже існує.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            try {
                $query = $pdo->prepare(
                    "INSERT INTO users (name, email, password)
                     VALUES (:username, :email, :password)"
                );

                $query->execute([
                    "username" => $username,
                    "email" => $email,
                    "password" => $hashedPassword
                ]);

                $message = "Реєстрація успішна! Тепер можете увійти.";
            } catch (PDOException $e) {
                $message = "Не вдалося зареєструвати користувача.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Реєстрація</title>
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
            padding: 30px;
            border-radius: 12px;
            width: 320px;
            box-shadow: 0 4px 15px #0001;
        }

        input,
        button {
            box-sizing: border-box;
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            background: #343a40;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #495057;
        }

        a {
            color: #343a40;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Реєстрація</h2>

        <form method="POST">
            <input type="text" name="username" placeholder="Ім'я користувача" maxlength="255" required>
            <input type="email" name="email" placeholder="Email" maxlength="255" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Зареєструватися</button>
        </form>

        <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>

        <p>Вже маєте акаунт? <a href="login.php">Увійти</a></p>
        <a href="index.php">На головну</a>
    </div>

</body>

</html>