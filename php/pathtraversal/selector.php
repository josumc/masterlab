<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Vehículos</title>
</head>
<body>

<?php
if (isset($_GET['table'])) {
    $table = $_GET['table'];
        include($table);
} else {
    echo "Por favor, proporciona un parámetro 'table' en la URL (coches.html o motos.html)";
}
?>

</body>
</html>
