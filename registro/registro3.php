<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="form3.css">
</head>
<body>
    <div class="box">
        <div class="formulario"> 
        <form action="../registro/registrarUsuarios.php" method="post" id="registroForm">
            <h1>Registrar Usuario</h1> 

            <p>Usuario: *</p> 
            <input type="text" required id="username" name="username">
            <p id="mensaje"></p>

            <p>Nombre Completo: *</p> 
            <input type="text" required id="nombre" name="nombre"> 

            <p>Correo: *</p> 
            <input type="email" required id="correo" name="correo"> <br>

            <p>Nueva Contraseña: *</p> 
            <input type="password" required id="password" name="pass">
            <span id="passwordError" class="error"></span><br>

            <p>Confirmar Contraseña: *</p>
            <input type="password" required id="confirmPassword" name="confirmPassword">
            <span id="confirmPasswordError" class="error"></span> <br><br><br>

            
            <div class="pregunta-seguridad">
                <p><strong>Pregunta de seguridad:</strong> ¿Cuál es la primera letra de la palabra 'gato'? *</p>
            </div>
            <input type="text" required id="pregunta" name="pregunta"> <br>

          
            <div class="captcha-container">
                <div class="g-recaptcha" data-sitekey="6LcBFsgqAAAAACv3ca6IPk85Knr-8Csd0zSLS48C"></div>
            </div>

            <input type="submit" value="Ingresar">
        </form>

        <a href="../loguin/inicioSesion.php">Inicio Sesión</a> <br>
        </div>
    </div>
    <script src="../javas/validacion2.js"></script>
    <script src="../javas/apiUser.js"></script>
</body>
</html>
