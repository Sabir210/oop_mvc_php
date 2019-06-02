<?php

// Define a class
class User {

    public $name;
    public $age;

    public function __construct($name, $age) {
        echo "Class: " . __CLASS__ . " instantiated<br>";
        $this->name = $name;
        $this->age = $age;
    }
    
    /*
        Called when no other references to a certain object.
        Used for cleanup, closing connections etc.
    */
    public function __destruct() {
        echo "Destructor ran!";
    }

    public function sayHello() {
        return $this->name . " says hello!";
    }
}

$user1 = new User("Jon", 27);
$user2 = new User("Samwell", 32);

echo $user1->name . " is " . $user1->age;
echo "<br>";
echo $user1->sayHello();
echo "<br>";
echo $user2->name . " is " . $user2->age;
echo "<br>";
echo $user2->sayHello();
