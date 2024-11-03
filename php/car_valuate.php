<?php
include('header.php');
?>

<div class="container my-5">
  <h2>Valora tu coche antiguo</h2>
  <form action="valuate.php" method="get">
    <div class="form-group mb-3">
      <label for="year">Año del coche</label>
      <input type="number" class="form-control" id="year" name="year" required>
    </div>
    <div class="form-group mb-3">
      <label for="kilometers">Kilómetros recorridos</label>
      <input type="number" class="form-control" id="kilometers" name="kilometers" required>
    </div>
    <div class="form-group mb-3">
      <label for="condition">Estado del coche</label>
      <select class="form-select" id="condition" name="condition" required>
        <option value="malo">Malo</option>
        <option value="regular">Regular</option>
        <option value="bueno">Bueno</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Valorar</button>
  </form>
</div>

<?php include('footer.php'); ?>
