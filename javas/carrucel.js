let carteles = document.querySelectorAll(".cartel2a");
let indiceActual = 0;

function cambiarCartel(direccion) {
    let cartelActual = carteles[indiceActual];
    cartelActual.classList.remove("active");
    cartelActual.classList.add("saliente");

    indiceActual += direccion;
    if (indiceActual >= carteles.length) indiceActual = 0;
    if (indiceActual < 0) indiceActual = carteles.length - 1;

    let nuevoCartel = carteles[indiceActual];
    setTimeout(() => {
        cartelActual.classList.remove("saliente");
        nuevoCartel.classList.add("active");
    }, 500);
}


cambiarCartel(1);


setInterval(() => cambiarCartel(1), 3000);
