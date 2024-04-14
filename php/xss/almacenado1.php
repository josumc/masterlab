<?php
$servername = "db";
$username = "user";
$password = "us3r";
$database = "test_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$username = $_POST['username'];
$mail = $_POST['mail'];

$sql = "INSERT INTO users (username, email) VALUES ('$username', '$mail')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario guardado correctamente.";
} else {
    echo "Error al guardar el usuario: " . $conn->error;
}

$conn->close();
?>
