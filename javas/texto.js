document.addEventListener("DOMContentLoaded", function () {
    const descripcionInput = document.getElementById("descripcion");
    const descripcionError = document.getElementById("descripcionError");
    const progressBar = document.getElementById("progress-bar");
    const maxCaracteres = 200;

    descripcionInput.addEventListener("input", function () {
        const descripcion = descripcionInput.value;
        const caracteresRestantes = maxCaracteres - descripcion.length;
        const porcentaje = (descripcion.length / maxCaracteres) * 100;

        
        if (caracteresRestantes < 0) {
            descripcionError.textContent = `Te has excedido en ${Math.abs(caracteresRestantes)} caracteres.`;
            descripcionError.style.color = "red";
        } else {
            descripcionError.textContent = ""
        }

        
        progressBar.style.width = `${Math.min(100, porcentaje)}%`;

        
        if (caracteresRestantes < 0) {
            progressBar.style.backgroundColor = "black";
        } else if (porcentaje > 75 && porcentaje<86) {
            progressBar.style.backgroundColor = "orange";            
        }else if(porcentaje > 85){
            progressBar.style.backgroundColor = "red";
        } else {
            progressBar.style.backgroundColor = "green";
        }
    });
});
