<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco XYZ</title>
</head>
<body>
    <h2>Bienvenido al Banco XYZ</h2>
    <?php
    if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
        echo "<p>¡Bienvenido! ". $_SESSION["user"] . " Estás autenticado.</p>";
    } else {
        echo "<p>No estás autenticado. Por favor, <a href='auth.php'>inicia sesión</a>.</p>";
    }
    ?>
    <p>Por favor, seleccione una opción:</p>
    <ul>
        <li><a href="transferencia.php">Realizar una transferencia</a></li>
    </ul>
</body>
</html>
