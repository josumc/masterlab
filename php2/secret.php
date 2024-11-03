<?php
header('Access-Control-Allow-Origin: https://cdn.cochesviejunos.es');
header('Content-Type: application/json');

$response = [
  "latitude" => 36.6875,
  "longitude" => -4.5,
  "generationtime_ms" => 0.022,
  "utc_offset_seconds" => 0,
  "timezone" => "GMT",
  "timezone_abbreviation" => "GMT",
  "elevation" => 0.0,
  "current_units" => [
    "time" => "iso8601",
    "interval" => "seconds",
    "temperature_2m" => "°C"
  ],
  "current" => [
    "time" => "2024-11-03T17:45",
    "interval" => 900,
    "temperature_2m" => "enhorabuena, has conseguido ejecutar el SSRF con éxito"
  ]
];

echo json_encode($response);
