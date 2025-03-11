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
            <form action="envioCorreo.php" method="POST">
            <h1>Restablece tu contraseña</h1> 

            <h3>Ingresa tu correo electronico registrado y se te enviara un correo con un codigo para poder cambiar tu contraseña:</h3> 


            <p>Correo electronico:  *</p> <input type="mail" required name="correo"> <br>

            <input type="submit" value="Enviar"> <br><br>
            </form>

            <a href="../loguin/inicioSesion.php">inicio Sesion</a> <br><br>
            
        </div>
        
    </div>
    
</body>
</html>
