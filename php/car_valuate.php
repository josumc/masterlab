<?php
include('header.php');

// Función para sanitizar y validar la entrada de los datos
function sanitize_input($data) {
    // Eliminar espacios en blanco al principio y al final
    $data = trim($data);
    // Eliminar caracteres no permitidos como saltos de línea, etc.
    $data = stripslashes($data);
    // Convertir caracteres especiales en entidades HTML para evitar inyecciones
    $data = htmlspecialchars($data);
    return $data;
}

$year = $kilometers = $condition = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Sanitize y validar los valores enviados por el formulario
    if (isset($_GET['year'])) {
        // Sanitizar el año (debe ser un número de 4 dígitos)
        $year = sanitize_input($_GET['year']);
        if (!filter_var($year, FILTER_VALIDATE_INT) || strlen($year) !== 4) {
            echo '<div class="alert alert-danger">Por favor, ingresa un año válido.</div>';
            $year = "";
        }
    }

    if (isset($_GET['kilometers'])) {
        // Sanitizar los kilómetros (debe ser un número)
        $kilometers = sanitize_input($_GET['kilometers']);
        if (!filter_var($kilometers, FILTER_VALIDATE_INT)) {
            echo '<div class="alert alert-danger">Por favor, ingresa un valor válido para los kilómetros.</div>';
            $kilometers = "";
        }
    }

    if (isset($_GET['condition'])) {
        // Sanitizar la condición (asegurarse de que sea uno de los valores válidos)
        $condition = sanitize_input($_GET['condition']);
        if (!in_array($condition, ['malo', 'regular', 'bueno'])) {
            echo '<div class="alert alert-danger">Por favor, selecciona una condición válida.</div>';
            $condition = "";
        }
    }
}
?>
