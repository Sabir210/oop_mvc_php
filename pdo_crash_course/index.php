<?php

$host = 'localhost';
$user = 'blogger';
$password = 'password';
$dbName = "pdo_crash_course";

// Set DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$dbName;";

// Create a PDO instance
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

#  PDO Query
// $stmt = $pdo->query("SELECT * FROM posts");
// while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     echo $row['title'] . "<br>";
// }
// while($row = $stmt->fetch()) {
//     echo $row->title . "<br>";
// }

#  PDO Prepared Statements
// Unsafe method
// $sql = "SELECT * FROM posts WHERE author = '$author'";

// Fetch multiple posts

// User input
$author = 'Jon';
$isPublished = TRUE;
$id = 1;
$limit = 1;

// Positional Params
$sql = "SELECT * FROM posts WHERE author = ? AND is_published = ? LIMIT ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$author, $isPublished, $limit]);
$posts = $stmt->fetchAll();

// Named Params
// $sql = "SELECT * FROM posts WHERE author = :author AND is_published = :published";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['author' => $author, 'published' => $isPublished]);
// $posts = $stmt->fetchAll();

// // var_dump($posts);
foreach ($posts as $post) {
    echo $post->title . "<br>";
}

// Fetch Single Post
// $sql = "SELECT * FROM posts WHERE id = :id";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['id' => $id]);
// $post = $stmt->fetch();

// echo $post->body;

// Get Row Count
// $stmt = $pdo->prepare("SELECT * FROM posts WHERE author = ?");
// $stmt->execute([$author]);
// $postCount = $stmt->rowCount();
// echo $postCount;

// Insert Data
// $title = 'Post 8';
// $body = 'This is post 8';
// $author = 'Rob';

// $sql = 'INSERT INTO posts(title, body, author) VALUES(:title, :body, :author)';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['title' => $title, 'body' => $body, 'author' => $author]);
// echo "Post added";

// Update Data
// $id = 7;
// $author = 'Arya';

// $sql = "UPDATE posts SET author = :author WHERE id = :id";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['author' => $author, 'id' => $id]);
// echo "Post updated";

// Delete Data
// $id = 3;

// $sql = "DELETE FROM posts WHERE id = :id";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['id' => $id]);
// echo "Post deleted";

// Search Data
// $search = '%5%';

// $sql = "SELECT * FROM posts WHERE title LIKE ?";
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$search]);
// $posts = $stmt->fetchAll();
// foreach ($posts as $post) {
//     echo $post->title . "<br>";
// }