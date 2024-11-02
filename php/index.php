<?php session_start(); ?>
<? include("db.php"); ?>


<? include("header.php"); ?>

<!-- Filtro por Marca -->
<div class="container my-4">
  <div class="filter-bar p-3 rounded text-center">
    <label for="marcaSelect" class="form-label">Filtrar por Marca:</label>
    <select class="form-select d-inline w-auto" id="marcaSelect" aria-label="Filtro por Marca">
      <option selected>Seleccione una marca</option>
      <option value="Ford">Ford</option>
      <option value="Chevrolet">Chevrolet</option>
      <option value="Volkswagen">Volkswagen</option>
      <option value="BMW">BMW</option>
      <!-- Agrega más marcas aquí -->
    </select>
  </div>
</div>

<!-- Galería de Coches -->
<div class="container">
  <div class="row">
    <?php
    // Suponiendo que tienes una conexión a la base de datos
    $db = db_connect();

    // Consulta para obtener todos los coches
    $query = $db->query('SELECT * FROM coches');

    // Recorrer cada coche y mostrarlo en la galería
    foreach ($query as $coche) {
      echo '<div class="col-md-4">
                        <div class="card">
                            <img src="' . 'imgs/' . $coche['foto'] . '" class="card-img-top" alt="' . $coche['marca'] . '">
                            <div class="card-body text-center">
                                <h5 class="card-title">' . $coche['modelo'] . '</h5>
                                <p class="card-text">Año: ' . $coche['anio'] . '</p>
                                <p class="card-text">Precio: ' . $coche['precio'] . ' €</p>
                                <a href="car_detail.php?id=' . $coche['id'] . '" class="btn btn-primary">Ver Detalles</a>
                            </div>
                        </div>
                      </div>';
    }
    ?>
  </div>
</div>

<? include("footer.php"); ?>
