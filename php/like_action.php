<?php
session_start();
include('db.php');

// Verificar que el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Verificar que el token CSRF sea válido
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('Token CSRF inválido');
}

// Conectar a la base de datos
$db = db_connect();

// Verificar y sanitizar los datos del formulario
if (!isset($_POST['car_id']) || empty($_POST['car_id']) || !is_numeric($_POST['car_id'])) {
    die('ID del coche inválido');
}
$car_id = (int) $_POST['car_id'];

// Obtener el usuario actual de la sesión
$currentUser = $_SESSION['username'] ?? null;

if (!$currentUser) {
    die('Usuario no autenticado');
}

// Obtener el ID del usuario a partir del nombre de usuario
$stmt = $db->prepare('SELECT id FROM users WHERE username = ?');
$stmt->bind_param('s', $currentUser);
$stmt->execute();
$userQuery = $stmt->get_result();
if ($userQuery->num_rows === 0) {
    die('Usuario no encontrado');
}
$user = $userQuery->fetch_assoc();
$user_id = $user['id'];

// Verificar si el usuario ya dio "me gusta" al coche
$stmt = $db->prepare('SELECT * FROM likes WHERE user_id = ? AND car_id = ?');
$stmt->bind_param('ii', $user_id, $car_id);
$stmt->execute();
$likeCheckQuery = $stmt->get_result();

if ($likeCheckQuery->num_rows > 0) {
    // Si ya dio "me gusta", eliminar el registro
    $stmt = $db->prepare('DELETE FROM likes WHERE user_id = ? AND car_id = ?');
    $stmt->bind_param('ii', $user_id, $car_id);
    $stmt->execute();
} else {
    // Si no dio "me gusta", agregar el registro
    $stmt = $db->prepare('INSERT INTO likes (user_id, car_id) VALUES (?, ?)');
    $stmt->bind_param('ii', $user_id, $car_id);
    $stmt->execute();
}

// Redirigir de vuelta a los detalles del coche
header('Location: car_details.php?id=' . $car_id);
exit;
