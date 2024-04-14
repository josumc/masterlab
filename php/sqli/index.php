<?php
$servername = "db";
$username = "user";
$password = "us3r";
$database = "test_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$marca = $_GET['marca'];

$sql = "SELECT * FROM coches WHERE marca='$marca'";
echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Coches de la marca $marca:</h2>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>Marca: " . $row["marca"] . ", Modelo: " . $row["modelo"] . ", Cilindrada: " . $row["cilindrada"] . "cc, Consumo: " . $row["consumo"] . "L/100km, Año: " . $row["anio"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No se encontraron coches de la marca $marca.";
}
$conn->close();
?>
