<?php

// Define el dominio permitido (sin especificar http/https)
$allowedDomain = 'cochesviejunos.es';

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Comprobamos si la solicitud proviene del dominio permitido, sin distinguir http/https
    if (strpos($_SERVER['HTTP_ORIGIN'], $allowedDomain) !== false) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
    } else {
        // Si el origen no es el permitido, bloqueamos el acceso
        header('Access-Control-Allow-Origin: none');
    }
} else {
    // Si no hay cabecera de origen, bloqueamos el acceso
    header('Access-Control-Allow-Origin: none');
}

header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

// Función para obtener el contenido desde una URL
function get_content($URL)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $URL);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  $data = curl_exec($ch);

  // Verificar errores de cURL
  if (curl_errno($ch)) {
    echo 'Error de cURL: ' . curl_error($ch);
    curl_close($ch);
    return null;
  }

  curl_close($ch);
  return $data;
}

// Validar y procesar la URL recibida a través de un parámetro GET
if (isset($_GET['url'])) {
  $url = base64_decode($_GET['url']);

  // Comprobar si la URL es válida
  if (filter_var($url, FILTER_VALIDATE_URL) === false) {
    die('URL no válida');
  }

  // Asegurarse de que la URL solicitada pertenece al dominio permitido de la API del tiempo
  if (strpos($url, 'api.open-meteo.com') !== false) {
    $json_data = get_content($url);
    echo $json_data;
  } else {
    die('Acceso no permitido a esta URL');
  }
} else {
  die('Parámetro de URL no proporcionado');
}

?>
