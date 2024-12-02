<?php

include_once("db.php");

// Función para serializar y codificar con Base64
function ser($username, $is_admin, $weather)
{
    // Los datos que vamos a serializar
    $data = [
        'username' => $username,
        'is_admin' => $is_admin,
        'weather' => $weather
    ];

    // Serializar los datos de manera segura y codificarlos en Base64
    $serializedData = serialize($data);
    $encodedData = base64_encode($serializedData);

    return $encodedData;
}

// Función para deserializar y decodificar con Base64
function deser($base64String)
{
    // Primero decodificamos la Base64
    $decodedData = base64_decode($base64String);

    // Comprobamos la validez de los datos antes de deserializar (opcional)
    if ($decodedData === false) {
        throw new Exception("Error al decodificar los datos.");
    }

    // Deserializamos los datos y los devolvemos
    $unserializedData = unserialize($decodedData);
    return $unserializedData;
}

// Función para crear la cookie de sesión del usuario
function create_cookie($username)
{
    // Conexión a la base de datos
    $conn = db_connect();

    // Consulta para obtener la información del usuario
    $sql = "SELECT id, is_admin, weather FROM users WHERE username='$username'";
    $result = $conn->query($sql);;

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Serializar y codificar la información del usuario
        $serinfo = ser($username, $row['is_admin'], $row['weather']);

        // Generar un token de seguridad con HMAC para garantizar la integridad
        $secretKey = 'josumc'; // Usamos la clave secreta 'josumc'
        $token = hash_hmac('sha256', $serinfo, $secretKey);

        // Establecer la cookie con los datos seguros, pero sin el token
        setcookie("user_info", $serinfo, time() + 36000, "/", "", true, true); // Cookie con datos serializados

        // Establecer la cookie con el token, pero en una cookie separada
        setcookie("user_token", $token, time() + 36000, "/", "", true, true); // Cookie con token
    } else {
        // Manejar el caso de error si no se encuentra el usuario
        throw new Exception("Usuario no encontrado.");
    }
}

// Función para verificar la validez de la cookie
function verify_cookie($cookie)
{
    // Si no hay cookie, retornamos false
    if (empty($cookie)) {
        return false;
    }

    // Obtener la cookie de token
    $token = isset($_COOKIE['user_token']) ? $_COOKIE['user_token'] : '';

    // Verificar que los datos no sean nulos y que el token coincida
    $secretKey = 'josumc'; // Usamos la misma clave secreta 'josumc'
    $expectedToken = hash_hmac('sha256', $cookie, $secretKey);

    // Si el token no coincide, la cookie ha sido manipulada
    if ($expectedToken !== $token) {
        return false;
    }

    // Si la cookie es válida, deserializamos los datos
    try {
        $userData = deser($cookie);
    } catch (Exception $e) {{
        return false; // Si la deserialización falla, retornamos false
    }

    // Si todo es válido, retornamos los datos del usuario
    return $userData;
}
?>
