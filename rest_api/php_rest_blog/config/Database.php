<?php
    
class Database {

    // DB params
    private $host = 'localhost';
    private $dbName = 'my_blog';
    private $username = 'blogger';
    private $password = 'password';
    private $conn;

    // DB Connect
    public function connect() {
        $this->conn = NULL;
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbName";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
        return $this->conn;
    }
}