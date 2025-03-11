<?php
include("../conexion.php");
// Incluir la biblioteca JWT
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

          
    $query = "SELECT * FROM usuarios WHERE ID='$user_id'";
    $resultado = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($resultado);
    $nombre = $row['Nombre'];
    $correo = $row['Correo'];
    $user = $row['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="datos.css">
</head>
<body>
    <div class="box">
        <div class="formulario"> 
          

        <form action="envioCambio.php" method="post" id="registroForm">
            <h1>Mis Datos </h1>
            <h4>Aqui podras actualizar tu dato que desees.</h4>

            <p>Usuario: </p> 
            <input type="text"  id="username" name="username" placeholder="<?php echo htmlspecialchars($user); ?>">
            <p id="mensaje"></p>

            <p>Nombre Completo: </p> 
            <input type="text"  id="nombre" name="nombre" placeholder="<?php echo htmlspecialchars($nombre); ?>"> 

            <p>Correo: </p> 
            <input type="email"  id="correo" name="correo" placeholder="<?php echo htmlspecialchars($correo); ?>"> <br>

                       
            
            <input type="submit" value="Actualizar">
        </form>

        <a href="../index/index2.php">Cancelar</a> <br>
        </div>
    </div>
    
    <script src="../javas/User2.js"></script>
</body>
</html>
