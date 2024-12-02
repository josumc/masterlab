<?php
include('header.php');

if (isset($_GET['year']) && isset($_GET['kilometers']) && isset($_GET['condition'])) {
    // Sanitizar las entradas para evitar cualquier tipo de inyección
    $year = filter_var($_GET['year'], FILTER_VALIDATE_INT);
    $kilometers = filter_var($_GET['kilometers'], FILTER_VALIDATE_INT);

    // Usar htmlspecialchars para sanitizar las entradas de texto
    $condition = htmlspecialchars($_GET['condition'], ENT_QUOTES, 'UTF-8');

    // Validación básica de las entradas
    if ($year === false || $kilometers === false || !in_array($condition, ['malo', 'regular', 'bueno'])) {
        echo "<div class='alert alert-danger'>Entrada no válida. Por favor, verifica los datos ingresados.</div>";
    } else {
        // Realizar los cálculos directamente en PHP sin necesidad de usar comandos del sistema
        $base_value = 10000 - $year;
        $discount = 0;

        if ($condition == 'malo') {
            $discount = 1000;
        } elseif ($condition == 'regular') {
            $discount = 500;
        }

        $valuation = $base_value - $discount;

        // Mostrar el resultado
        echo "<div class='container my-5'>
                <h3>Valor estimado: € $valuation</h3>
                <div class='alert alert-warning text-center mt-3'>
                    Advertencia, nuestra valoración no es vinculante y se trata de una estimación hecha <b>con la calculadora del sistema</b>.
                </div>
              </div>";
    }
}

include('footer.php');
