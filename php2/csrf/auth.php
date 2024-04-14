<?php
session_start();

$user = "pepe";
$password = "1234";
$cta = "1234-5678-9999";

if (isset($_POST['user']) && isset($_POST['password'])) {
    if ($_POST['user'] === $user && $_POST['password'] === $password) {
        $_SESSION['autenticado'] = true;
        $_SESSION['cta'] = $cta;
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit;
    } else {
        die("El usuario o contraseña no son válidos");
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <form action="auth.php" method="POST">
        <label for="user">Usuario:</label><br>
        <input type="text" id="user" name="user" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>
