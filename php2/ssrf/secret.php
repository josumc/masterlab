<?php
if($_SERVER['REMOTE_ADDR'] !== '172.21.0.3') {
    http_response_code(403);
    echo json_encode(array("error" => "Acceso no autorizado."));
    exit;
}

$file = 'datos.json';

if (file_exists($file)) {
    $json_data = file_get_contents($file);

    if ($json_data === false) {
        http_response_code(500);
        echo json_encode(array("error" => "Error al leer el archivo."));
        exit;
    }

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    echo $json_data;
} else {
    http_response_code(404);
    echo json_encode(array("error" => "El archivo no existe."));
}
?>
