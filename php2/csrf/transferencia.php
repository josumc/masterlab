<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transferencia de fondos</title>
</head>
<body>
    <h2>Transferencia de fondos</h2>
    <?php
    if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
        echo "<p>¡Bienvenido! ". $_SESSION["user"] . " Estás autenticado.</p>";
    } else {
        echo "No está autenticado. Redirigiendo a autenticacion";
        echo '<meta http-equiv="refresh" content="2;url=auth.php">';
        die();
    }

    $cuenta_usuario = $_SESSION["cta"];

    if (isset($_POST['cuenta_destino']) && isset($_POST['cantidad'])) {
        $cuenta_destino = $_POST['cuenta_destino'];
        $cantidad = $_POST['cantidad'];

        echo "Transferencia realizada: $cantidad de $cuenta_usuario a $cuenta_destino.";
    }
    ?>
    <form action="transferencia.php" method="POST">
        <label for="cuenta_destino">Cuenta de destino:</label><br>
        <input type="text" id="cuenta_destino" name="cuenta_destino" required><br>
        <label for="cantidad">cantidad:</label><br>
        <input type="number" id="cantidad" name="cantidad" min="1" required><br><br>
        <input type="submit" value="Realizar transferencia">
    </form>
</body>
</html>
