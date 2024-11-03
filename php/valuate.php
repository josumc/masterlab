<?php
include('header.php');

if (isset($_GET['year']) && isset($_GET['kilometers']) && isset($_GET['condition'])) {
  $year = $_GET['year'];
  $kilometers = $_GET['kilometers'];
  $condition = $_GET['condition'];

  $command = "expr 10000 - " . $year;
  if ($condition == 'malo') {
    $command .= " - 1000";
  } elseif ($condition == 'regular') {
    $command .= " - 500";
  }

  $valuation = shell_exec($command);


  echo "<div class='container my-5'>
            <h3>Valor estimado: € $valuation</h3>
            <div class='alert alert-warning text-center mt-3'>
                Advertencia, nuestra valoración no es vinculante y se trata de una estimación.
            </div>
          </div>";
}

include('footer.php');

