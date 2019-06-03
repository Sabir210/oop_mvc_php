<?php

class User {
    protected $name;
    protected $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }
}

class Customer extends User {

    private $balance;

    public function __construct($name, $age, $balance) {
        parent::__construct($name, $age);
        $this->balance = $balance;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function pay($amount) {
        return $this->name . " paid £" . $amount;
    }
}

$customer1 = new Customer('John', 33, 35000);
// echo $customer1->pay(10000);
echo $customer1->getBalance();