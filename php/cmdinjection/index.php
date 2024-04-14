<!DOCTYPE html>
<html>
<head>
    <title>Listar Archivos del Directorio</title>
</head>
<body>

<h2>Listar Archivos del Directorio</h2>

<form method="GET">
    <label for="directorio">Ingrese la ruta del directorio:</label><br>
    <select name="directorio">
        <option value="datos">datos</option>
        <option value="imagenes">imagenes</option>
        <option value="texto">texto</option>
    </select><br><br>
    <input type="submit" value="Listar Archivos">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['directorio'])) {
        $directorio = $_GET['directorio'];
        $ls_output = shell_exec("ls -l $directorio");
        echo "<h3>Archivos en el directorio $directorio:</h3>";
        echo "<pre>$ls_output</pre>";
    } else {
        echo "Por favor, proporcione un directorio.";
    }
}
?>

</body>
</html>
