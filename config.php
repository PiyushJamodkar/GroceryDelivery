<?php

$host = "sql204.infinityfree.com";
$user = "if0_42852387";
$pass = "7vXJHHCr2wo4i";
$db = "if0_42852387_grocerydelivery";
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection is currently unavailable.");
}

mysqli_set_charset($conn, "utf8mb4");

?>