function loadDescription() {
    const modeloCoche = document.getElementById("carmodel").innerText.trim();

    if (modeloCoche) {
        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `https://cdn.cochesviejunos.es/get-car-description.php?file=${modeloCoche}`,
            true,
        );

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("car-description").innerText =
                    xhr.responseText;
            }
        };

        xhr.send();
    } else {
        console.error("No se encontró el parámetro modelo en la URL");
    }
}

window.onload = loadDescription;
