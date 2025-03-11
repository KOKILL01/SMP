<?php
session_start();
if (!isset($_SESSION['correo'])) {
    die("Acceso denegado. Inicia sesión primero.");
}

$userCorreo = $_SESSION['correo'];

include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $contraseña = $_POST["pass"];
    $contraseña2 = $_POST["confirmPassword"];

    if (strlen($contraseña) >= 8 && preg_match('/[A-Z]/', $contraseña) && preg_match('/\d/', $contraseña)) {
        if ($contraseña == $contraseña2) {
            



            $contrahash=password_hash($contraseña, PASSWORD_DEFAULT);

            $sql = "UPDATE usuarios SET Contraseña = '$contrahash' WHERE Correo = '$userCorreo'";
            $result=$conexion->query($sql);

            if($result){
                echo "<script type='text/javascript'>
                alert('¡Contraseña Cambiada Con exito!');
                window.location.href='../loguin/inicioSesion.php';
                </script>";
            }else{
                echo "<script type='text/javascript'>
                alert('¡Datos incorrecto, sigues las indicaciones!');
                 window.history.back();
                </script>";
            }

            



        }

    }

}


?>