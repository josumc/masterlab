<?php
session_start();
require_once 'conexion.php';

if (isset($_SESSION['usuario_id'])) {
    header("Location: perfil.php?user_id=".$_SESSION['usuario_id']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT id, pass FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (md5($contrasena) === $row['pass']) {
            $_SESSION['usuario_id'] = $row['id'];
            header("Location: perfil.php?user_id=".$_SESSION['usuario_id']);
            exit();
        }
    }

    $mensaje_error = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <h1>Iniciar sesión</h1>
    <?php if(isset($mensaje_error)) { ?>
        <p style="color: red;"><?php echo $mensaje_error; ?></p>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena"><br><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>
