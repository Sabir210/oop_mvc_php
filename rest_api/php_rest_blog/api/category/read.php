<?php

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

// Blog post query
$result = $category->read();
// Get row count
$num = $result->rowCount();

// Check if any categories
if($num > 0) {
    // Post array
    $catArr = array();
    $catArr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $catItem = array(
            'id' => $id,
            'name' => $name,
        );

        // Push to 'data'
        array_push($catArr['data'], $catItem);
    }

    // Convert to JSON & output
    echo json_encode($catArr);
} else {
    echo json_encode(
        array('message' => "No categories found")
    );
}