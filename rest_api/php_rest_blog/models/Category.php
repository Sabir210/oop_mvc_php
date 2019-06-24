<?php

class Category {
  // DB Stuff
  private $conn;
  private $table = 'categories';

  // Post Properties
  public $id;
  public $name;
  public $created_at;

  // Constructor with DB
  public function __construct($db) {
    $this->conn = $db;
  }

  // Get categories
  public function read() {
    $query = "SELECT
        id,
        name,
        created_at
      FROM
        {$this->table}
      ORDER BY
        created_at DESC";
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }  
   
}