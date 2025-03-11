<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="form2.css">
</head>
<body>
    <div class="box">
        <div class="formulario"> 
            <form action="logueo.php" method="POST">
            <h1>Iniciar sesion</h1> 

            <p>Nombre de usuario:  *</p> <input type="text" required name="nombreu"> 


            <p>Contraseña:  *</p> <input type="password" required name="contraseña"> <br>

            <input type="submit" value="Ingresar"> <br><br>
            </form>
            <a href="../registro/registro3.php">Registro</a> <br><br>
            
            <a href="../cambioContraseña/cambio.php">¿Olvidaste tu contraseña...? !Cambiala aqui!</a> <br>
        </div>
        
    </div>
    
</body>
</html>
