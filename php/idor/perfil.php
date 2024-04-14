<?php
session_start();
require_once 'conexion.php';

function estaAutenticado() {
    return isset($_SESSION['usuario_id']);
}

function obtenerDetallesUsuario($conn, $id) {
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

if (!estaAutenticado()) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_GET['user_id'];

$detalles_usuario = obtenerDetallesUsuario($conn, $usuario_id);

echo "<h1>Detalles del Usuario</h1>";
echo "<p>ID: " . $detalles_usuario['id'] . "</p>";
echo "<p>Username: " . $detalles_usuario['username'] . "</p>";
echo "<p>Email: " . $detalles_usuario['email'] . "</p>";

echo "<br>";
echo "<a href='logout.php'>Cerrar sesión</a>";

?>
