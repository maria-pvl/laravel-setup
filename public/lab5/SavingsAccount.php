<?php

require_once "BankAccount.php";

class SavingsAccount extends BankAccount
{
    public static $interestRate = 5;

    public function applyInterest()
    {
        $interest = $this->balance * self::$interestRate / 100;

        if ($interest > 0) {
            $this->deposit($interest);
        }

        return $interest;
    }
}

?>