<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Creador de enlaces con saludos personalizados y secretos</title>
    <script>
        function encodeToBase64(str) {
            return btoa(str);
        }

        function updateBase64Encoding() {
            const input = document.getElementById('inputField').value;
            const encoded = "http://left:81/template/saludo.php?secreto=" + encodeToBase64(input);
            document.getElementById('encodedOutput').textContent = encoded;
        }
    </script>
</head>
<body>
    <h1>Creador de enlaces con saludos personalizados y secretos</h1>
    <label for="inputField">Introduce tu saludo:</label>
    <input type="text" id="inputField" oninput="updateBase64Encoding()">
    <h2>Enlace con saludo secreto</h2>
    <div id="encodedOutput" style="padding:10px; width:50%; word-wrap: break-word;"></div>
</body>
</html>
