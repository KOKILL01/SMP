const usernameInput = document.getElementById('username');
const mensaje = document.getElementById('mensaje');
const formulario = document.getElementById('registroForm');

let usuarioDisponible = false;


usernameInput.addEventListener('input', function () {
    const username = this.value;
    fetch(`../api_User.php?username=${username}`)
        .then(response => response.json())
        .then(data => {
            if (data.disponible) {
                mensaje.textContent = 'Nombre de usuario disponible';
                mensaje.style.color = 'green';
                usuarioDisponible = true;
            } else {
                mensaje.textContent = 'Nombre de usuario no disponible';
                mensaje.style.color = 'red';
                usuarioDisponible = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});


formulario.addEventListener('submit', function (e) {
    if (!usuarioDisponible) {
        e.preventDefault();
        alert('Por favor, elige un nombre de usuario disponible.');
    }

});