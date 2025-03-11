document.addEventListener("DOMContentLoaded",function(){

    const numeroTargeta=document.getElementById("targeta");
    const targetaError=document.getElementById("targetaError");
    const codigo=document.getElementById("codigo");
    const seguridadError=document.getElementById("seguridadError");

    function validarTargeta(targeta){
        const regex= /^(?=.*\d).{16,16}$/;
        return regex.test(targeta);
    }

    function validarCodigo(Ncodigo){
        const regex= /^(?=.*\d).{3,3}$/;
        return regex.test(Ncodigo);
    }


    numeroTargeta.addEventListener("input",function(){
        const targeta=numeroTargeta.value;
        if(!validarTargeta(targeta)){

            targetaError.textContent="Debe ingresar 16 caracteres";
            targetaError.style.color="red";
        }else{
            targetaError.textContent="";
        }
    })

    codigo.addEventListener("input",function(){
        const Ncodigo=codigo.value;
        if(!validarCodigo(Ncodigo)){

            seguridadError.textContent="Debe ingresar 3 caracteres";
            seguridadError.style.color="red";
        }else{
            seguridadError.textContent="";
        }
    })


})