<?php
interface AccountInterface {
    public function deposit($amount);
    public function withdraw($amount);
    public function getBalance();
}

class BankAccount implements AccountInterface {
    const MIN_BALANCE = 0;
    protected $balance;
    protected $currency;

    public function __construct($currency, $initialBalance=0) {
        $this->currency = $currency;
        $this->balance = $initialBalance;
    }

    public function deposit($amount) {
        if ($amount <= 0)
            throw new Exception("Сума для поповнення має бути позитивною");
        
        $this->balance += $amount;
        echo "Поповнено на {$amount} {$this->currency}. Новий баланс: {$this->balance} {$this->currency}.<br>";
    }

    public function withdraw($amount) {
        if ($amount <= 0)
            throw new Exception("Сума для зняття має бути позитивною.");
        if ($amount > $this->balance)
            throw new Exception("Недостатньо коштів.");

        $this->balance -= $amount;
        echo "Знято {$amount} {$this->currency}. Новий баланс: {$this->balance} {$this->currency}.<br>";
    }

    public function getBalance() {
        return $this->balance;
    }
}

class SavingsAccount extends BankAccount {
    public static $interestRate = 0.1;

    public function applyInterest() {
        $interest = $this->balance * self::$interestRate;
        $this->balance += $interest;
        echo "Застосовано відсоток. Додано {$interest} {$this->currency}. Новий баланс: {$this->balance} {$this->currency}.<br>";
    }
}


$account1 = new BankAccount("USD", 100);
$account1->deposit(50);
$account1->withdraw(30);
echo "Поточний баланс: " . $account1->getBalance() . " USD<br>";

try {
    $account1->withdraw(150);
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}

try {
    $account1->withdraw(-1);
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}

try {
    $account1->deposit(-10);
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}

$savingsAccount = new SavingsAccount("EUR", 200);
$savingsAccount->applyInterest();
$savingsAccount->deposit(100);
$savingsAccount->withdraw(50);
echo "Поточний баланс: " . $savingsAccount->getBalance() . " EUR<br>";

?>