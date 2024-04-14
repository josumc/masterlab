<?php
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: GET, OPTIONS");

header("Access-Control-Allow-Headers: Content-Type");

$data = file_get_contents("data.json");

header("Content-Type: application/json");

echo $data;
?>
