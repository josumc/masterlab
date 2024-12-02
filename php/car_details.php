<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('Location: login.php');
  exit;
}

include('header.php');
include('db.php'); ?>

<div class="container my-5">
  <div class="row">
    <?php
    $db = db_connect();

    // Validar y sanitizar el parámetro 'id'
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id <= 0) {
      echo '<p>Coche no encontrado.</p>';
      include 'footer.php';
      exit;
    }

    $stmt = $db->prepare('SELECT * FROM coches WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $coche = $stmt->get_result()->fetch_assoc();

    if ($coche) {
      echo '<div class="col-md-6 col-12 mb-4">
                <img src="imgs/' . htmlspecialchars($coche['foto'], ENT_QUOTES, 'UTF-8') . '" class="img-fluid car-image" alt="' . htmlspecialchars($coche['marca'], ENT_QUOTES, 'UTF-8') . '">
                <div class="mt-3">
                  <h4>Usuarios que han dado "me gusta"</h4>';

      $likesQuery = $db->prepare('SELECT u.username FROM likes l JOIN users u ON l.user_id = u.id WHERE l.car_id = ?');
      $likesQuery->bind_param('i', $id);
      $likesQuery->execute();
      $likesResult = $likesQuery->get_result();

      while ($like = $likesResult->fetch_assoc()) {
        echo '<a href="public_profile.php?username=' . htmlspecialchars($like['username'], ENT_QUOTES, 'UTF-8') . '" class="badge bg-primary me-1 mb-1">' . htmlspecialchars($like['username'], ENT_QUOTES, 'UTF>      }

      echo '</div>';

      $hasLikedQuery = $db->prepare('SELECT * FROM likes WHERE user_id = (SELECT id FROM users WHERE username = ?) AND car_id = ?');
      $hasLikedQuery->bind_param('si', $_SESSION['username'], $id);
      $hasLikedQuery->execute();
      $hasLiked = $hasLikedQuery->get_result()->num_rows > 0;

      // Incluir el token CSRF en el formulario
      echo '<form action="like_action.php" method="post" class="mt-3">
              <input type="hidden" name="car_id" value="' . $id . '">
              <input type="hidden" name="csrf_token" value="' . htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') . '">
              <button type="submit" class="btn btn-' . ($hasLiked ? 'danger' : 'success') . '">' .
        ($hasLiked ? 'Ya no me gusta' : 'Me gusta') . '</button>
            </form>';

      echo '</div>';

      echo '<div class="col-md-6 col-12 d-flex flex-column">
                <div class="info-box mb-3 p-3 bg-light">
                  <h3>' . htmlspecialchars($coche['marca'], ENT_QUOTES, 'UTF-8') . '</h3>
                  <p><strong>Año:</strong> ' . htmlspecialchars($coche['anio'], ENT_QUOTES, 'UTF-8') . '</p>
                  <p><strong>Modelo:</strong> <div id="carmodel">' . htmlspecialchars($coche['modelo'], ENT_QUOTES, 'UTF-8') . '.txt</div></p>
                  <p><strong>Precio:</strong> €' . htmlspecialchars($coche['precio'], ENT_QUOTES, 'UTF-8') . '</p>
                </div>
                <div class="desc-box p-3 bg-light">
                  <h4>Descripción</h4>
                <div id="car-description"></div>';
      echo '  </div>
              </div>';

      echo '<div class="mt-3">
              <button onclick="window.location.href=\'redirect.php?url=index.php\'" class="btn btn-secondary">Volver</button>
            </div>';
    } else {
      echo '<p>Coche no encontrado.</p>';
    }
    ?>
  </div>
</div>

<style>
</style>

<script src="js/cardetails.js"></script>

<?php include 'footer.php'; ?>
