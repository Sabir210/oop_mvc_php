<?php

function returnMethod() {
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method'])) {
        return $_POST['_method'];
    } else {
        return $_SERVER['REQUEST_METHOD'];
    }
}

echo returnMethod();

?>

<h1>My Form</h1>

<h3>GET</h3>
<form action="" method="GET">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="submit" value="Submit" style="display: block; margin-top: 10px;">
</form>

<br>

<h3>POST</h3>
<form action="" method="POST">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="submit" value="Submit" style="display: block; margin-top: 10px;">
</form>

<br>

<h3>PUT</h3>
<form action="" method="POST">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="hidden" name="_method" value="PUT">
    <input type="submit" value="Submit" style="display: block; margin-top: 10px;">
</form>

<br>

<h3>DELETE</h3>
<form action="" method="POST">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="hidden" name="_method" value="DELETE">
    <input type="submit" value="Submit" style="display: block; margin-top: 10px;">
</form>

<br>

<a href="test.php">RESET PAGE</a>