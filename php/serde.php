<?php

include_once("db.php");

function ser($username, $is_admin, $weather)
{
  $data = [
    'username' => $username,
    'is_admin' => $is_admin,
    'weather' => $weather
  ];

  $serializedData = base64_encode(serialize($data));

  return $serializedData;
}

function deser($base64String)
{
  $decodedData = base64_decode($base64String);
  $unserializedData = unserialize($decodedData);
  return $unserializedData;
}

function create_cookie($username)
{
  $conn = db_connect();
  $sql = "SELECT id, is_admin, weather FROM users WHERE username='$username'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $serinfo = ser($username, $row['is_admin'], $row['weather']);
  setcookie("user_info", $serinfo, time() + 36000, "/");
}
