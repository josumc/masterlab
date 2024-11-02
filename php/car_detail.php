<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalles del Coche | Coches Viejunos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  </style>
</head>

<body>

  <?php include('header.php');
  include('db.php'); ?>

  <div class="container my-5">
    <div class="row">
      <?php
      $db = db_connect();
      $id = $_GET['id'];
      $coche = $db->query('SELECT * FROM coches WHERE id = ' . $id)->fetch_array();

      if ($coche) {
        // Columna para la imagen del coche
        echo '<div class="col-md-6 col-12 mb-4">
                <img src="imgs/' . $coche['foto'] . '" class="img-fluid car-image" alt="' . $coche['marca'] . '">
              </div>';

        // Columna para los detalles (ficha y descripción)
        echo '<div class="col-md-6 col-12 d-flex flex-column">
                <div class="info-box mb-3 p-3 bg-light">
                  <h3>' . $coche['marca'] . '</h3>
                  <p><strong>Año:</strong> ' . $coche['anio'] . '</p>
                  <p><strong>Modelo:</strong> ' . $coche['modelo'] . '</p>
                  <p><strong>Precio:</strong> €' . $coche['precio'] . '</p>
                </div>
                <div class="desc-box p-3 bg-light">
                  <h4>Descripción</h4>';

        // Cargar descripción desde archivo de texto
        $descripcionFile = 'txts/' . $coche['modelo'] . '.txt';
        if (file_exists($descripcionFile)) {
          $descripcion = file_get_contents($descripcionFile);
          echo '<p>' . nl2br($descripcion) . '</p>';
        } else {
          echo '<p>Descripción no disponible.</p>';
        }

        echo '  </div>
              </div>';
      } else {
        echo '<p>Coche no encontrado.</p>';
      }
      ?>
    </div>
  </div>

  <style>
    .car-image {
      max-width: 100%;
      height: auto;
    }

    .info-box,
    .desc-box {
      border-radius: 8px;
      background-color: #f0f8ff;
    }
  </style>


  <?php include 'footer.php'; ?>

  <!-- Scripts de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
