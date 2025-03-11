<?php
include("../conexion.php");

require '../src/JWT.php';
require '../src/Key.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


// Obtener el token de la cookie
$token = $_COOKIE['jwt'] ?? null;

if (!$token) {
    // Si no hay token, redirigir al login
    die("Acceso denegado. Inicia sesión primero.");
}

try {
    // Verificar y decodificar el token
    $decoded = JWT::decode($token, new Key(SECRET_KEY, 'HS256'));
    $user_id = $decoded->id; // Obtener el ID del usuario desde el payload
} catch (Exception $e) {
    // Token inválido o expirado
    die("Acceso denegado. Token inválido o expirado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $raza = mysqli_real_escape_string($conexion, $_POST["raza"]);
    $edad = mysqli_real_escape_string($conexion, $_POST["edad"]);
    $lugar = mysqli_real_escape_string($conexion, $_POST["perdio"]);
    $recompensa = mysqli_real_escape_string($conexion, $_POST["dinero"]);
    $descripcion = mysqli_real_escape_string($conexion, $_POST["descripcion"]);
    $numero = mysqli_real_escape_string($conexion, $_POST["numero"]);
    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $imagen = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
    } else {
        $imagen = null; 
    }
    
    $sql = "INSERT INTO carteles (nombre, raza, edad, lugar, descripcion, recompensa,numero,idusuario,imagen) 
            VALUES ('$nombre', '$raza', '$edad', '$lugar', '$descripcion', '$recompensa','$numero','$user_id',";
    
    $sql .= ($imagen !== null) ? "'$imagen')" : "NULL)";

    if ($conexion->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
        alert('¡Registro Exitoso!');
        window.location.href='../index/index2.php';
        </script>";
    } else {
        echo "Error al registrar el cartel: " . $conexion->error;
    }
}
?>
