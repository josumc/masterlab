<?php

function db_connect()
{

  $conn = new mysqli();

  $servername = getenv('DB_SERVER') ?: "db";
  $username = getenv('DB_USER') ?: "user";
  $password = getenv('DB_PASSWORD') ?: "us3r";
  $database = getenv('DB_NAME') ?: "test_db";

  $conn = new mysqli($servername, $username, $password, $database);

  if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
  }

  $conn->set_charset("utf8mb4");

  return $conn;
}
