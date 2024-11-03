<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('Location: login.php');
  exit;
}
include('header.php');

echo '<div class="alert alert-success text-center">Operación realizada con éxito.</div>';

include('footer.php');
