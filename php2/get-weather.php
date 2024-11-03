<?php

header('Access-Control-Allow-Origin: https://cochesviejunos.es');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

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

if (isset($_GET['url'])) {
  $url = base64_decode($_GET['url']);

  if (filter_var($url, FILTER_VALIDATE_URL) === false) {
    die('URL no válida');
  }

  $json_data = get_content($url);
  echo $json_data;
}
