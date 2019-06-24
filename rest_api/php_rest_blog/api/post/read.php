<?php

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Blog post query
$result = $post->read();
// Get row count
$num = $result->rowCount();

// Check if any posts
if($num > 0) {
    // Post array
    $postsArr = array();
    $postsArr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $postItem = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'categoryId' => $category_id,
            'category_name' => $category_name
        );

        // Push to 'data'
        array_push($postsArr['data'], $postItem);
    }

    // Convert to JSON & output
    echo json_encode($postsArr);
} else {
    echo json_encode(
        array('message' => "No posts found")
    );
}