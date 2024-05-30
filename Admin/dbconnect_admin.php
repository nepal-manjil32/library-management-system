<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "library_mgn_sys";

$conn = new mysqli($server, $username, $password, $database, 3307);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}

$email = "";
$name = "";
$errors = array();

?>
