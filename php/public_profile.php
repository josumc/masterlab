<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('Location: login.php');
  exit;
}

include('header.php');
include('db.php');

$db = db_connect();

// Sanitizar el parámetro de entrada 'username' para evitar inyección SQL y XSS
$username = isset($_GET['username']) ? htmlspecialchars($_GET['username'], ENT_QUOTES, 'UTF-8') : '';
$stmt = $db->prepare('SELECT username, name, description, image FROM users WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$query = $stmt->get_result();

if ($query->num_rows === 0) {
  echo '<div class="container my-5"><p>No se encontraron datos para este usuario.</p></div>';
  include('footer.php');
  exit;
}

$user = $query->fetch_assoc();
?>

<div class="container my-5">
  <div class="row">
    <div class="col-md-4 text-center">
      <img src="imgs/users/<?php echo htmlspecialchars($user['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Foto de perfil" class="img-fluid rounded">
    </div>
    <div class="col-md-8">
      <h2>Perfil público de <?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
      <ul class="list-unstyled">
        <li><strong>Nombre de usuario:</strong> <?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></li>
        <li><strong>Descripción:</strong> <?php echo htmlspecialchars($user['description'], ENT_QUOTES, 'UTF-8'); ?></li>
      </ul>
    </div>
  </div>
</div>

<?php
include('footer.php');
?>
