<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: /');
    exit;
}

include("db.php");
include("serde.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar entrada
    $username = trim(htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8'));
    $password = trim($_POST['password']); // Contraseña no se escapa para preservar su formato

    $conn = db_connect();

    // Usar consultas preparadas para evitar inyección SQL
    $stmt = $conn->prepare("SELECT id, pass, is_admin, weather FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verificar la contraseña con password_verify
        if (password_verify($password, $row['pass'])) {
            // Establecer la sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            // Generar el token CSRF para sesiones activas
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

            //Crear cookies
            create_cookie($username);

            header('Location: /');
            exit();
        }
    }

    $error = 'Usuario o contraseña incorrectos';
}

include('header.php');
?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="text-center mb-4">Iniciar Sesión</h2>
      <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
        </div>
      <?php endif; ?>
      <form action="" method="post">
        <div class="form-group">
          <label for="username">Usuario</label>
          <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-send">Iniciar Sesión</button>
      </form>
    </div>
  </div>
  <div class="container mt-4 text-center">
    <p>¿No tienes una cuenta? <a href="register.php">Crea tu perfil aquí</a></p>
  </div>
</div>

<?php include('footer.php'); ?>
