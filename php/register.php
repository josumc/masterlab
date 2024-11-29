<?php
include('db.php');

function generateApiKey()
{
  return md5(uniqid(rand(), true));
}

$default_widget_url = "https://api.open-meteo.com/v1/forecast?latitude=36.71&longitude=-4.42&current=temperature_2m";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db = db_connect();

  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $address = $_POST['address'];
  $description = $_POST['description'];
  $apiKey = generateApiKey();

  $checkQuery = $db->query("SELECT * FROM users WHERE email = '$email' OR username = '$username'");
  if ($checkQuery->num_rows > 0) {
    echo '<div class="alert alert-danger text-center">El correo o nombre de usuario ya están en uso.</div>';
  } else {
    $targetDir = "imgs/users/";
    $photoName = basename($_FILES['photo']['name']);
    $targetFilePath = $targetDir . $photoName;
    move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath);

    $db->query("INSERT INTO users (name, username, email, pass, address, description, image, apikey,weather) VALUES ('$name', '$username', '$email', '$password', '$address', '$description', '$photoName', '$apiKey', '$default_widget_url')");

    header('Location: register.php?message=success');
    exit;
  }
}

include('header.php');
?>

<div class="container my-5 d-flex justify-content-center">
  <div class="col-md-4">
    <?php if (isset($_GET['message']) && $_GET['message'] === 'success'): ?>
      <div class="alert alert-success text-center">Cuenta creada con éxito. Ahora puedes <a href="login.php">iniciar sesión</a>.</div>
    <?php else: ?>
      <h2 class="text-center">Registro de Usuario</h2>
      <form action="register.php" method="post" enctype="multipart/form-data">
        <div class="form-group mb-3">
          <label for="name">Nombre</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group mb-3">
          <label for="username">Usuario</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group mb-3">
          <label for="email">Correo Electrónico</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group mb-3">
          <label for="password">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group mb-3">
          <label for="address">Dirección</label>
          <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group mb-3">
          <label for="description">Descripción</label>
          <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group mb-3">
          <label for="photo">Subir Fotografía</label>
          <input type="file" class="form-control" id="photo" name="photo" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
      </form>
    <?php endif; ?>
  </div>
</div>

<?php include('footer.php'); ?>
