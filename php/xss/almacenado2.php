<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Almacenados</title>
</head>
<body>
    <h1>Usuarios Almacenados</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre de Usuario</th>
        </tr>
        <?php
        $servername = "db";
        $username = "user";
        $password = "us3r";
        $database = "test_db";

        $conn = new mysqli($servername, $username, $password, $database, 3306);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $sql = "SELECT id, username, email FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td>". $row["email"] . "</td></tr>";
            }
        } else {
            echo "No hay usuarios almacenados.";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
