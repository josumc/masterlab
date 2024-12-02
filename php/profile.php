<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('Location: login.php');
  exit;
}

include('db.php');
$db = db_connect();

// Obtener el username de manera segura
$username = isset($_GET['username']) ? $_GET['username'] : '';

// Verificar que el usuario logueado sea el mismo que el perfil que se está editando
if ($_SESSION['username'] !== $username) {
  die("No tienes permiso para acceder a este perfil.");
}

// Usar consultas preparadas para evitar inyección SQL
$stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$query = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validar y sanitizar las entradas del formulario
  $newDescription = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
  $newWeather = htmlspecialchars($_POST['weather'], ENT_QUOTES, 'UTF-8');

  // Actualizar los datos usando consultas preparadas
  $updateStmt = $db->prepare('UPDATE users SET description = ?, weather = ? WHERE username = ?');
  $updateStmt->bind_param('sss', $newDescription, $newWeather, $username);

  // Verificar si la actualización fue exitosa
  if ($updateStmt->execute()) {
    header("Location: success.php");
    exit;
  } else {
    echo 'Error al actualizar los datos: ' . $updateStmt->error;
  }
}

include('header.php');

// Verificar si el usuario existe
if ($query->num_rows === 0) {
  echo '<div class="container my-5"><p>No se encontraron datos para este usuario.</p></div>';
  include('footer.php');
  exit;
}

// Obtener los datos del usuario
$user = $query->fetch_assoc();
$weather = htmlspecialchars($user['weather'], ENT_QUOTES, 'UTF-8');

?>

<div class="container my-5">
  <div class="row">
    <div class="col-md-3 text-center">
      <img src="imgs/users/<?php echo htmlspecialchars($user['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Foto de perfil" class="img-fluid rounded">
    </div>
    <div class="col-md-4">
      <h2>Perfil de <?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
      <ul class="list-unstyled">
        <li><strong>Nombre de usuario:</strong> <?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></li>
        <li><strong>Correo:</strong> <?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></li>
        <li><strong>Dirección:</strong> <?php echo htmlspecialchars($user['address'], ENT_QUOTES, 'UTF-8'); ?></li>
        <li><strong>Descripción:</strong> <?php echo htmlspecialchars($user['description'], ENT_QUOTES, 'UTF-8'); ?></li>
      </ul>
    </div>
    <div class="col-md-4">
      <div style="margin-top: 15px;"><strong>API Key:</strong> <?php echo htmlspecialchars($user['apikey'], ENT_QUOTES, 'UTF-8'); ?></div>
      <div style="margin-top: 15px; margin-bottom: 15px;">
        <strong>Weather URL:</strong> <?php echo $weather; ?>
      </div>
      <h5>Cambiar valores</h5>
      <form action="profile.php?username=<?php echo urlencode($username); ?>" method="post">
        <div class="form-group mb-3">
          <label>Descripción</label>
          <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($user['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
          <label>Weather API Url</label>
          <textarea class="form-control" id="weather" name="weather" required><?php echo $weather; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </form>
    </div>
  </div>
</div>

<?php
include('footer.php');
?>
