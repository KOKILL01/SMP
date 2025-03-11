document.addEventListener("DOMContentLoaded", function() {
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const passwordError = document.getElementById("passwordError");
    const confirmPasswordError = document.getElementById("confirmPasswordError");
    const registroBtn = document.getElementById("registroBtn");

    
    function validarPassword(password) {
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        return regex.test(password);
    }


    
    
    passwordInput.addEventListener("input", function() {
        const password = passwordInput.value;
        if (!validarPassword(password)) {
            passwordError.textContent = "La contraseña debe tener al menos 8 caracteres, una letra minuscula, mayuscula y un número.";
            passwordError.style.color = "red";
        } else {
            passwordError.textContent = "";
        }
    });



    
    confirmPasswordInput.addEventListener("input", function() {
        if (confirmPasswordInput.value !== passwordInput.value) {
            confirmPasswordError.textContent = "Las contraseñas no coinciden.";
            confirmPasswordError.style.color = "red";
        } else {
            confirmPasswordError.textContent = "";
        }
    });



    // Prevenir envío si hay errores
    registroBtn.addEventListener("click", function(event) {
        if (!validarPassword(passwordInput.value)) {
            alert("Corrige la contraseña antes de registrarte.");
            event.preventDefault();
        } else if (confirmPasswordInput.value !== passwordInput.value) {
            alert("Las contraseñas no coinciden.");
            event.preventDefault();
        } else {
            alert("¡Registro exitoso!");
        }
    });
});
