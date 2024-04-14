<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSRF Demo</title>
</head>
<body>
    <h1>SSRF Demo</h1>

    <form method="POST" action="">
        <label for="url">URL:</label><br>
        <input type="text" id="url" name="url" value="https://api.open-meteo.com/v1/forecast?latitude=52.52&longitude=13.41&current=temperature_2m,wind_speed_10m"><br><br>
        <input type="submit" value="Cargar datos">
    </form>

    <?php
    if(isset($_POST['url'])){
        $url = $_POST['url'];
        $json_data = file_get_contents($url);
        $data = json_decode($json_data);
        ?>

        <div id="datos">
            <h2>Datos del Clima</h2>
            <p>Temperatura: <?php echo $data->current->temperature_2m; ?>°C</p>
            <p>Velocidad del Viento: <?php echo $data->current->wind_speed_10m; ?> m/s</p>
        </div>
        <div id="json-crudo" style="margin-top: 20px; white-space: pre-wrap;">
            <h2>JSON Crudo</h2>
            <pre><?php echo $json_data; ?></pre>
        </div>
    <?php
    }
    ?>

</body>
</html>
