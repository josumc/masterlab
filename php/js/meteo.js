function fetchWeatherData() {
    var url = document.getElementById("weather").getAttribute("data-value");
    url = window.btoa(url);
    const xhr = new XMLHttpRequest();
    xhr.open(
        "GET",
        `https://cdn.cochesviejunos.es/get-weather.php?url=${url}`,
        true,
    );

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Muestra la respuesta en la consola
            try {
                const response = JSON.parse(xhr.responseText);
                document.getElementById("weather").innerText =
                    response.current.temperature_2m + " ºC";
            } catch (error) {
                console.error("Error al analizar el JSON:", error);
                console.error(xhr);
            }
        }
    };

    xhr.send();
}

window.onload = fetchWeatherData;
