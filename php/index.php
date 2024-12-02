<?php session_start(); ?>
<?php include("db.php"); ?>
<?php include("header.php"); ?>

<div class="container my-4">
  <div class="filter-bar p-3 rounded text-center">
    <div class="d-flex align-items-center">
      <a href="car_valuate.php" class="btn btn-secondary me-3" style="background-color: orange; color: white;">Evalua tu coche viejuno!</a>
      <?php
      if (isset($_COOKIE['user_info'])) {
        include('serde.php');
        $user_info = deser($_COOKIE['user_info']);
        $weather = $user_info['weather'];
        echo "<div>Temperatura en Málaga: <span id='weather' data-value='$weather'></span></div>";
      }
      ?>
      <!-- Si el usuario está logueado le saldrá un widget del tiempo con la temperatura.
      Esperemos que sea seguro cargar url remotas o ...
      (anotación del equipo de CochesViejunos) -->
      <form class="d-flex justify-content-end" action="search.php" method="get" autocomplete="off" style="max-width: 400px; margin-left: auto;">
        <input class="form-control me-2" type="search" placeholder="Buscar coches" aria-label="Buscar" name="q">
        <button class="btn btn-custom" type="submit" style="background-color: orange; color: white;">Buscar</button>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <?php
    // Conectar a la base de datos
    $db = db_connect();

    // Consulta segura con consulta preparada
    $stmt = $db->prepare('SELECT * FROM coches');

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->get_result();

    // Mostrar los resultados
    while ($coche = $result->fetch_assoc()) {
      echo '<div class="col-md-4">
                        <div class="card">
                            <img src="' . 'imgs/' . htmlspecialchars($coche['foto'], ENT_QUOTES, 'UTF-8') . '" class="card-img-top" alt="' . htmlspecialchars($coche['marca'], ENT_QUOTES, 'UTF-8') . '">
                            <div class="card-body text-center">
                                <h5 class="card-title">' . htmlspecialchars($coche['modelo'], ENT_QUOTES, 'UTF-8') . '</h5>
                                <p class="card-text">Año: ' . htmlspecialchars($coche['anio'], ENT_QUOTES, 'UTF-8') . '</p>
                                <p class="card-text">Precio: ' . htmlspecialchars($coche['precio'], ENT_QUOTES, 'UTF-8') . ' €</p>
                                <a href="car_details.php?id=' . urlencode($coche['id']) . '" class="btn btn-primary">Ver Detalles</a>
                            </div>
                        </div>
                      </div>';
    }
    ?>
  </div>
</div>

<script src="js/meteo.js"></script>
<?php include("footer.php"); ?>
