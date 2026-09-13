<?php

$host = "YOUR_HOST";
$user = "YOUR_USERNAME";
$pass = "YOUR_PASSWORD";
$db   = "YOUR_DATABASE";
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection is currently unavailable.");
}

mysqli_set_charset($conn, "utf8mb4");

?>
