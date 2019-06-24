<?php

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Get Raw Posted Data
$data = json_decode(file_get_contents("php://input"));
$post->id = $data->id;

// Update Post
if($post->delete()) {
    echo json_encode(
        Array('message' => "Post deleted")
    );
} else {
    echo json_encode(
        Array('message' => "Post not deleted")
    );
}