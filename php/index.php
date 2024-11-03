<?php session_start(); ?>
<? include("db.php"); ?>
<? include("header.php"); ?>

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
    $db = db_connect();

    $query = $db->query('SELECT * FROM coches');

    foreach ($query as $coche) {
      echo '<div class="col-md-4">
                        <div class="card">
                            <img src="' . 'imgs/' . $coche['foto'] . '" class="card-img-top" alt="' . $coche['marca'] . '">
                            <div class="card-body text-center">
                                <h5 class="card-title">' . $coche['modelo'] . '</h5>
                                <p class="card-text">Año: ' . $coche['anio'] . '</p>
                                <p class="card-text">Precio: ' . $coche['precio'] . ' €</p>
                                <a href="car_details.php?id=' . $coche['id'] . '" class="btn btn-primary">Ver Detalles</a>
                            </div>
                        </div>
                      </div>';
    }
    ?>
  </div>
</div>

<script src="js/meteo.js"></script>
<? include("footer.php"); ?>
