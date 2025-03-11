<?php
session_start();
include("../conexion.php");


require '../src/JWT.php';
require '../src/Key.php';
use Firebase\JWT\JWT;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["nombreu"];
    $contra = $_POST["contraseña"];

    
    $sql = "SELECT ID, Contraseña FROM usuarios WHERE username = '$user'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hash_almacenado = $row["Contraseña"]; 
        $user_id = $row["ID"];

        
        if (password_verify($contra, $hash_almacenado)) {
           
            $payload = [
                'id' => $user_id, 
                'name' => $user,   
                'iat' => time(),   
                'exp' => time() + 3600, 
            ];

           
            $jwt = JWT::encode($payload, SECRET_KEY, 'HS256');

            
            setcookie('jwt', $jwt, time() + 3600, '/', '', false, true); // Cookie segura
            echo json_encode(['token' => $jwt]); 

            
            header("Location: ../index/index2.php");
            exit();
        } else {
            
            echo "<script type='text/javascript'>
                    alert('¡Contraseña incorrecta!');
                    window.location.href='../loguin/inicioSesion.php';
                  </script>";
        }
    } else {
        // Usuario no encontrado
        echo "<script type='text/javascript'>
                alert('¡Usuario no encontrado!');
                window.location.href='../loguin/inicioSesion.php';
              </script>";
    }
}
?>