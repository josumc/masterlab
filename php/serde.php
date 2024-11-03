<?php

function ser($username, $is_admin)
{
  $data = [
    'username' => $username,
    'is_admin' => $is_admin
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
