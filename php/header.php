<!-- header.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coches Viejunos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <style>
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="imgs/logo.png" alt="Coches Viejunos" width="250">
      </a>
      <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) : ?>
        <?php if ($_SERVER['PHP_SELF'] !== '/login.php') : ?>
          <div class="ms-auto">
            <a href="login.php" class="btn btn-login">Iniciar Sesión</a>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </nav>
