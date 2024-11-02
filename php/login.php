<?php include('header.php'); ?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="text-center mb-4">Iniciar Sesión</h2>
      <form action="login_process.php" method="post">
        <div class="form-group">
          <label for="username">Usuario</label>
          <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
        </div>
        <div class=" form-group">
          <label for="password">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-send">Iniciar Sesión</button>
      </form>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>
