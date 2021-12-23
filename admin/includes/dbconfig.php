<?php

// Define connection  variables
$hostname = "localhost";
$username = "root";
$password = "";
$database = "Blog_test";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die('<script>alert("Connection Failed to database .")</script>');
}

?>