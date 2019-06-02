<?php

class User {

    private $name;
    private $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // __GET magic method
    public function __get($property) {
        if(property_exists($this, $property)) {
            return $this->$property;
        }
    }

    // __SET magic method
    public function __set($property, $value) {
        if(property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }
}

$user1 = new User("Jon", 27);
$user2 = new User("Samwell", 32);

// echo $user1->setName("Aegon");
// echo $user1->getName();

echo $user1->__get('name');
echo "<br>";
$user1->__set('name', 'Aegon');
echo $user1->__get('name');