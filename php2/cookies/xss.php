<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saludo PHP</title>
</head>
<body>
<?php
if(isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];

    echo "<h1>¡Hola, $nombre!</h1>";
} else {
    echo "<h1>¡Hola, Invitado!</h1>";
}
?>

<form action="" method="GET">
    <label for="nombre">Introduce tu nombre:</label><br>
    <input type="text" id="nombre" name="nombre"><br><br>
    <input type="submit" value="Saludar">
</form>
</body>
</html>
