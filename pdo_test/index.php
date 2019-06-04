<?php
$host = 'localhost';
$user = 'blogger';
$password = 'password';
$dbname = 'pdotest';

// Set DSN
$dsn = "mysql:host=$host;dbname=$dbname";

// Create a PDO instance
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$status = 'admin';

$sql = "SELECT * FROM users WHERE status = :status";
$stmt = $pdo->prepare($sql);
$stmt->execute(['status' => $status]);
$users = $stmt->fetchAll();
print_r($users);
// foreach($users as $user) {
//     echo $user->name;
//     echo "<br>";
// }

// $name = "Ned Stark";
// $email = "winteriscomig@gmail.com";
// $status = 'guest';

// $sql = "INSERT INTO users(name, email, status) VALUES (:name, :email, :status)";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['name' => $name, 'email' => $email, 'status' => $status]);
// echo "Added user";