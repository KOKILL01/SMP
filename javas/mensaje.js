
document.getElementById("cargarBtn").addEventListener("click", function() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "https://api.adviceslip.com/advice", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            document.getElementById("contenido").innerHTML = `
                <h2>Consejo:</h2>
                <p>${data.slip.advice}</p>
            `;
        }
    };
    xhr.send();
});
