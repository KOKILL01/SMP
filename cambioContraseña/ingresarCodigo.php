<?php
session_start();

if (!isset($_SESSION['correo'])) {
    die("Acceso denegado. Inicia sesión primero.");
}

$userCorreo = $_SESSION['correo'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cambio.css">
</head>
<body>
    <div class="box">
        <div class="formulario"> 
            <form action="valCodigo.php" method="POST">
            <h1>Ingresa el codigo que te llego al correo</h1> 

            <h3>Ingresa el codigo:</h3> 


            <p>Codigo:  *</p> <input type="number" required name="codigo"> <br>

            <input type="submit" value="Enviar"> <br><br>
            </form>

            <a href="../loguin/inicioSesion.php">inicio Sesion</a> <br><br>
            
        </div>
        
    </div>
    
</body>
</html>
