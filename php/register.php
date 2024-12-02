<?php
include('db.php');

// Función para generar la API Key
function generateApiKey()
{
  return md5(uniqid(rand(), true));
}

$default_widget_url = "https://api.open-meteo.com/v1/forecast?latitude=36.71&longitude=-4.42&current=temperature_2m";

// Procesamiento del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db = db_connect();

  // Sanitización de los datos de entrada
  $name = htmlspecialchars(trim($_POST['name']));
  $username = htmlspecialchars(trim($_POST['username']));
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT); // Usamos bcrypt para cifrar la contraseña
  $address = htmlspecialchars(trim($_POST['address']));
  $description = htmlspecialchars(trim($_POST['description']));
  $apiKey = generateApiKey();

  // Comprobamos si el correo o el nombre de usuario ya existen en la base de datos
  $checkQuery = $db->query("SELECT * FROM users WHERE email = '$email' OR username = '$username'");
  if ($checkQuery->num_rows > 0) {
    echo '<div class="alert alert-danger text-center">El correo o nombre de usuario ya están en uso.</div>';
  } else {
    // Directorio donde se almacenarán las imágenes
    $targetDir = "imgs/users/";

    // Sanitización y generación de un nombre único para el archivo
    $photoName = uniqid('user_', true) . '.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $targetFilePath = $targetDir . $photoName;

    // Validación del archivo de imagen
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    // Verificamos que el archivo sea una imagen válida
    $checkImage = getimagesize($_FILES['photo']['tmp_name']);
    if ($checkImage !== false && in_array($fileType, $allowedTypes)) {
      // La imagen es válida, moverla al directorio de destino
      if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
        // Insertar los datos del usuario en la base de datos
        $db->query("INSERT INTO users (name, username, email, pass, address, description, image, apikey, weather)
                    VALUES ('$name', '$username', '$email', '$password', '$address', '$description', '$photoName', '$apiKey', '$default_widget_url')");

        header('Location: register.php?message=success');
        exit;
      } else {
        echo '<div class="alert alert-danger text-center">Hubo un error al subir la imagen.</div>';
      }
    } else {
      echo '<div class="alert alert-danger text-center">Por favor, suba una imagen válida (JPG, JPEG, PNG, GIF).</div>';
    }
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
