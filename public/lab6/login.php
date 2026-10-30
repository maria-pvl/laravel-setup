<?php
session_start();
require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $query = $pdo->prepare(
        "SELECT id, name, password FROM users WHERE name = :username"
    );

    $query->execute([
        "username" => $username
    ]);

    $user = $query->fetch();

    if ($user && password_verify($password, $user["password"])) {
        session_regenerate_id(true);

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["name"];

        header("Location: welcome.php");
        exit;
    } else {
        $message = "Неправильний логін або пароль.";
    }
}
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

        .message {
            color: #c0392b;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Авторизація</h2>

        <form method="POST">
            <input type="text" name="username" placeholder="Ім'я користувача" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Увійти</button>
        </form>

        <p class="message"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>

        <p>Ще не маєте акаунта? <a href="register.php">Зареєструватися</a></p>
        <a href="index.php">На головну</a>
    </div>

</body>

</html>