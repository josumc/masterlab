<?php
$servername = "db";
$username = "user";
$password = "us3r";
$database = "test_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
