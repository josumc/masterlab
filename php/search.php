<?php
include('header.php');

// Obtener y sanitizar la entrada del parámetro 'q'
$searchQuery = isset($_GET['q']) ? $_GET['q'] : '';
$searchQuery = htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8');
?>

<div class="container my-5">
  <h2>Resultados de la búsqueda</h2>
  <p>Su búsqueda de <strong><?php echo $searchQuery; ?></strong> no ha tenido resultados.</p>
</div>

<?php
include('footer.php');
?>
