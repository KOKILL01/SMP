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
            <form action="cambiarContraseñaN.php" method="POST">
            <h1>Cambiaremos tu contraseña</h1> 

            <p>Nueva Contraseña: *</p> 
            <input type="password" required id="password" name="pass">
            <span id="passwordError" class="error"></span><br>

            <p>Confirmar Contraseña: *</p>
            <input type="password" required id="confirmPassword" name="confirmPassword">
            <span id="confirmPasswordError" class="error"></span> <br><br><br>

            <input type="submit" value="Enviar"> <br><br>
            </form>

            <a href="../loguin/inicioSesion.php">inicio Sesion</a> <br><br>
            
        </div>
        
    </div>
    <script src="../javas/validacion2.js"></script>
</body>
</html>
