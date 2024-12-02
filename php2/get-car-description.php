<?php

// Permitir acceso solo desde el dominio 'cochesviejunos.es' con cualquier protocolo
$allowedDomain = 'cochesviejunos.es';

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Extraemos el dominio sin considerar el protocolo (http:// o https://)
    $origin = parse_url($_SERVER['HTTP_ORIGIN'], PHP_URL_HOST);

    if ($origin === $allowedDomain) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
    } else {
        header('Access-Control-Allow-Origin: none');  // Negar acceso desde otros orígenes
    }
} else {
    header('Access-Control-Allow-Origin: none');  // Si no hay origen, negamos el acceso
}

// Logica para la carga de archivos...
if (isset($_GET['file'])) {
    // Sanitizar el nombre del archivo y prevenir Path Traversal
    $filename = basename($_GET['file']);  // `basename` elimina cualquier ruta anterior como `../`

    // Verificar que el archivo está dentro del directorio permitido
    $allowedDirectory = __DIR__ . '/txts/';
    $filepath = $allowedDirectory . $filename;

    // Comprobar que el archivo existe y que está dentro del directorio permitido
    if (file_exists($filepath) && strpos(realpath($filepath), $allowedDirectory) === 0) {
        // Enviar los encabezados adecuados
        header('Content-Type: text/plain');
        echo file_get_contents($filepath);
    } else {
        // Si no se encuentra el archivo o el archivo no está en el directorio permitido
        http_response_code(404);
        echo 'Archivo no encontrado';
    }
} else {
    // Si no se proporciona el parámetro 'file'
    http_response_code(400);
    echo 'Parámetro de archivo no proporcionado';
}

?>
