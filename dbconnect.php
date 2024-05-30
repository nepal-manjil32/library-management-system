<?php
$server = "localhost";
$username = "root";
$password = "0130";
$database = "users";

$conn = new mysqli($server, $username, $password, $database, 3307);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}
?>