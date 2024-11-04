<?php

if (isset($_GET['url'])) {
  $url = $_GET['url'];

  header("Location: $url");
  exit;
} else {
  echo "<p>No se proporcionó ninguna URL para redirigir.</p>";
}
