<?php
session_start();
include('db.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('Location: login.php');
  exit;
}

$db = db_connect();

$car_id = $_POST['car_id'];
$currentUser = $_POST['username'];

$userQuery = $db->query('SELECT id FROM users WHERE username = "' . $currentUser . '"');
$user = $userQuery->fetch_assoc();
$user_id = $user['id'];

$likeCheckQuery = $db->query('SELECT * FROM likes WHERE user_id = ' . $user_id . ' AND car_id = ' . $car_id);

if ($likeCheckQuery->num_rows > 0) {
  $db->query('DELETE FROM likes WHERE user_id = ' . $user_id . ' AND car_id = ' . $car_id);
} else {
  $db->query('INSERT INTO likes (user_id, car_id) VALUES (' . $user_id . ', ' . $car_id . ')');
}

header('Location: car_details.php?id=' . $car_id);
exit;
