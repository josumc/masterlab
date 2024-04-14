<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS Reflejado</title>
</head>
<body>
    <h1>Saludo</h1>
    <form action="" method="GET">
        <label for="nombre">Introduce tu nombre:</label>
        <input type="text" id="nombre" name="nombre">
        <button type="submit">Enviar</button>
    </form>

    <?php
    if(isset($_GET['nombre'])) {
        $nombre = $_GET['nombre'];

        echo "<p>Hola, $nombre</p>";
    }
    ?>
</body>
</html>
