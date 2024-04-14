<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serializar Datos de Usuario</title>
</head>
<body>
    <h2>Ingrese sus datos:</h2>
    <form action="ser.php" method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>
        <input type="submit" value="Guardar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];

        $usuario = new Usuario($nombre, $correo);

        $datos_serializados = serialize($usuario);

        file_put_contents("usuario.dat", $datos_serializados);

        echo "<p>Datos serializados y guardados correctamente.</p>";
    }
    ?>

</body>
</html>

<?php
class Usuario {
    public $nombre;
    public $correo;
    public $admin = false; // Por defecto, el usuario no es admin

    public function __construct($nombre, $correo) {
        $this->nombre = $nombre;
        $this->correo = $correo;
    }
}
?>
