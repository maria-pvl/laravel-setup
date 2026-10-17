<?php

require_once "AccountInterface.php";
require_once "BankAccount.php";
require_once "SavingsAccount.php";

session_start();

if (!isset($_SESSION["account"])) {
    $_SESSION["account"] = new BankAccount(1000, "USD");
    $_SESSION["savings"] = new SavingsAccount(1000, "USD");
}

$message = "";
$messageType = "success";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    try {
        if ($action === "deposit") {
            $amount = $_POST["amount"] ?? "";

            if (!is_numeric($amount) || $amount <= 0) {
                throw new Exception("Введіть додатну суму поповнення.");
            }

            $accountType = $_POST["account"] ?? "";

            if ($accountType === "account") {
                $_SESSION["account"]->deposit($amount);
                $message = "Звичайний рахунок успішно поповнено.";
            } elseif ($accountType === "savings") {
                $_SESSION["savings"]->deposit($amount);
                $message = "Накопичувальний рахунок успішно поповнено.";
            } else {
                throw new Exception("Невідомий рахунок.");
            }
        } elseif ($action === "withdraw") {
            $amount = $_POST["amount"] ?? "";

            if (!is_numeric($amount) || $amount <= 0) {
                throw new Exception("Введіть додатну суму зняття.");
            }

            $accountType = $_POST["account"] ?? "";

            if ($accountType === "account") {
                $_SESSION["account"]->withdraw($amount);
                $message = "Кошти успішно знято зі звичайного рахунку.";
            } elseif ($accountType === "savings") {
                $_SESSION["savings"]->withdraw($amount);
                $message = "Кошти успішно знято з накопичувального рахунку.";
            } else {
                throw new Exception("Невідомий рахунок.");
            }
        } elseif ($action === "interest") {
            $interest = $_SESSION["savings"]->applyInterest();

            $message = "Нараховано відсотків: "
                . number_format($interest, 2) . " USD.";
        } elseif ($action === "reset") {
            $_SESSION["account"] = new BankAccount(1000, "USD");
            $_SESSION["savings"] = new SavingsAccount(1000, "USD");

            $message = "Рахунки скинуто до початкового балансу.";
        } else {
            throw new Exception("Невідома операція.");
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
        $messageType = "error";
    }

    $_SESSION["message"] = $message;
    $_SESSION["messageType"] = $messageType;

    header("Location: index.php");
    exit;
}

if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    $messageType = $_SESSION["messageType"];

    unset($_SESSION["message"]);
    unset($_SESSION["messageType"]);
}

$account = $_SESSION["account"];
$savings = $_SESSION["savings"];

function showBalance(AccountInterface $account)
{
    return number_format($account->getBalance(), 2)
        . " " . $account->getCurrency();
}

?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Банківські рахунки</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 16px;
            background: #f3f5f9;
            color: #253047;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        header {
            padding: 30px;
            margin-bottom: 24px;
            background: #243b64;
            color: white;
            border-radius: 16px;
        }

        header h1 {
            margin: 0 0 10px;
            font-size: 28px;
        }

        header p {
            margin: 0;
            color: #dbe5f6;
            line-height: 1.6;
        }

        .card {
            padding: 24px;
            margin-bottom: 20px;
            background: white;
            border: 1px solid #e1e6ef;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(30, 45, 70, 0.04);
        }

        h2 {
            margin-top: 0;
            font-size: 21px;
        }

        .balance {
            margin: 16px 0 22px;
            padding: 20px;
            background: #f2f5fb;
            border-radius: 12px;
        }

        .balance p {
            margin: 0 0 8px;
            color: #637089;
        }

        .balance strong {
            font-size: 28px;
            color: #243b64;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 14px;
            border: 1px solid #cdd5e2;
            border-radius: 8px;
            font-size: 16px;
        }

        input:focus {
            outline: 2px solid #8ca9df;
            border-color: #456db3;
        }

        .buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        button {
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            background: #315a9b;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #243b64;
        }

        .secondary {
            background: #64748b;
        }

        .secondary:hover {
            background: #475569;
        }

        .interest {
            background: #16805d;
        }

        .interest:hover {
            background: #116448;
        }

        .message {
            padding: 15px 18px;
            margin-bottom: 20px;
            border-radius: 10px;
            line-height: 1.5;
        }

        .success {
            background: #e6f6ed;
            color: #18794e;
        }

        .error {
            background: #fdebea;
            color: #b42318;
        }

        .hint {
            color: #637089;
            font-size: 14px;
            line-height: 1.5;
        }
    </style>
</head>

<body>

    <div class="container">

        <header>
            <h1>Банківські рахунки</h1>
        </header>

        <?php if ($message !== ""): ?>
            <div class="message <?= htmlspecialchars($messageType) ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <section class="card">
            <h2>Звичайний рахунок</h2>

            <div class="balance">
                <p>Поточний баланс</p>
                <strong>
                    <?= htmlspecialchars(showBalance($account)) ?>
                </strong>
            </div>

            <form method="post" action="index.php">
                <label for="amount-account">Сума операції (USD)</label>

                <input type="number" id="amount-account" name="amount" min="0.01" step="0.01"
                    placeholder="Наприклад, 250" required>

                <input type="hidden" name="account" value="account">

                <div class="buttons">
                    <button type="submit" name="action" value="deposit">
                        Поповнити
                    </button>

                    <button type="submit" name="action" value="withdraw" class="secondary">
                        Зняти кошти
                    </button>
                </div>
            </form>
        </section>

        <section class="card">
            <h2>Накопичувальний рахунок</h2>

            <div class="balance">
                <p>Поточний баланс</p>
                <strong>
                    <?= htmlspecialchars(showBalance($savings)) ?>
                </strong>
            </div>

            <form method="post" action="index.php">
                <label for="amount-savings">Сума операції (USD)</label>

                <input type="number" id="amount-savings" name="amount" min="0.01" step="0.01"
                    placeholder="Наприклад, 100" required>

                <input type="hidden" name="account" value="savings">

                <div class="buttons">
                    <button type="submit" name="action" value="deposit">
                        Поповнити
                    </button>

                    <button type="submit" name="action" value="withdraw" class="secondary">
                        Зняти кошти
                    </button>
                </div>
            </form>

            <p class="hint">
                Річна ставка: <?= SavingsAccount::$interestRate ?>%.
            </p>

            <form method="post" action="index.php">
                <button type="submit" name="action" value="interest" class="interest">
                    Нарахувати відсотки
                </button>
            </form>
        </section>

        <section class="card">
            <h2>Скидання рахунків</h2>

            <p class="hint">
                Повертає обидва рахунки до початкового балансу 1000 USD.
            </p>

            <form method="post" action="index.php">
                <button type="submit" name="action" value="reset" class="secondary">
                    Скинути рахунки
                </button>
            </form>
        </section>

    </div>

</body>

</html>