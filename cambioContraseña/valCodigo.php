<?php
include("../conexion.php");
session_start();
if (!isset($_SESSION['correo'])) {
    die("Acceso denegado. Inicia sesión primero.");
}

$userCorreo = $_SESSION['correo'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cod = $_POST["codigo"];

    $sql = "SELECT codigo FROM codicoscambioc WHERE codigo = '$cod'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        
        echo "<script type='text/javascript'>
        alert('¡Codigo Correcto, cambiemos tu contraseña!');
        window.location.href='../cambioContraseña/cambiar.php';
        </script>";
    } else {
        
        echo "<script type='text/javascript'>
        alert('¡Codigo Equivocado!');
        window.history.back();
        </script>";
    }
}
?>