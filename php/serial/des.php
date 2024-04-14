<?php
class Usuario {
    public $nombre;
    public $correo;
    public $admin = false;
    public function __construct($nombre, $correo) {
        $this->nombre = $nombre;
        $this->correo = $correo;
    }
}

$datos_serializados = file_get_contents("usuario.dat");

$usuario = unserialize($datos_serializados);

echo "Nombre: " . $usuario->nombre . "<br>";
echo "Correo: " . $usuario->correo . "<br>";

if ($usuario->admin) {
    echo "¡Bienvenido ". $usuario->nombre ." Administrador!";
} else {
    echo "Hola ". $usuario->nombre . " Eres un usuario sin privilegios.";
}
?>
