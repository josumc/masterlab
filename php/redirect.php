<?php
// Lista blanca de URLs permitidas para redirigir
$allowed_urls = [
    'index.php',
    'profile.php',
    'car_details.php'
];

if (isset($_GET['url'])) {
    // Sanitizar y validar la URL
    $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);

    // Verificar si la URL es relativa y está en la lista blanca
    if (in_array($url, $allowed_urls)) {
        header("Location: $url");
        exit;
    } else {
        // Si la URL no es válida o no está permitida, redirigir a una página segura
        header("Location: index.php");
        exit;
    }
} else {
    echo "<p>No se proporcionó ninguna URL para redirigir.</p>";
}
