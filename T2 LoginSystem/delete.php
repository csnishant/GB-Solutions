<?php
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM users WHERE id = $id");


//temp table only for current current php script, if script ends, it gets deleted automatically
$conn->query("CREATE TEMPORARY TABLE temp_users LIKE users");


$conn->query("INSERT INTO temp_users (username, email, password) SELECT username, email, password FROM users");

$conn->query("DELETE FROM users");

// reset auto-increment to 1
$conn->query("ALTER TABLE users AUTO_INCREMENT = 1");
$conn->query("INSERT INTO users (username, email, password) SELECT username, email, password FROM temp_users");

header("Location: index.php");
exit();
?>
