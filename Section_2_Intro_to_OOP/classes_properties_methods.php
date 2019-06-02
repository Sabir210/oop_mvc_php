<?php

// Define a class
class User {
    // Properties (attributes)
    public $name;

    // Methods (functions)
    public function sayHello() {
        return $this->name . " says hello!";
    }
}

// Instantiate new user object from user class
$user1 = new User();
$user2 = new User();
$user1->name = "Jon";
$user2->name = "Samwell";
// User 1
echo $user1->name;
echo "<br>";
echo $user1->sayHello();
echo "<br>";
// User 2
echo $user2->name;
echo "<br>";
echo $user2->sayHello();