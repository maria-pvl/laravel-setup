<?php

require_once "AccountInterface.php";

class BankAccount implements AccountInterface
{
    const MIN_BALANCE = 0;

    protected $balance;
    protected $currency;

    public function __construct($balance = 0, $currency = "USD")
    {
        if (!is_numeric($balance) || $balance < self::MIN_BALANCE) {
            throw new Exception("Некоректний початковий баланс");
        }

        $this->balance = (float) $balance;
        $this->currency = $currency;
    }

    public function deposit($amount)
    {
        if (!is_numeric($amount) || $amount <= 0) {
            throw new Exception("Сума поповнення повинна бути додатною");
        }

        $this->balance += (float) $amount;
    }

    public function withdraw($amount)
    {
        if (!is_numeric($amount) || $amount <= 0) {
            throw new Exception("Сума зняття повинна бути додатною");
        }

        if ($amount > $this->balance) {
            throw new Exception("Недостатньо коштів");
        }

        $this->balance -= (float) $amount;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function getCurrency()
    {
        return $this->currency;
    }
}

?>