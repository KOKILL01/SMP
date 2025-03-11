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


if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Asegura que es un número entero

    $query = "SELECT * FROM carteles WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($resultado);

    if (!$row) {
        die("Cartel no encontrado.");
    }
} else {
    die("ID no proporcionado.");
}





?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Cartel</title>
    <link rel="stylesheet" href="../detalles/detalles4.css">
</head>
<body>
    
    <div class="page">
        <div class="header">
            <img src="../imagen/amor.png" alt="Logotipo" width=5%>
            <h1>SMP</h1>
            
            <a class="debut" href="../index/index2.php"><button class="but"><img src="../imagen/casap.png" alt="Logotipo" width=50%></button></a>
        </div>
        
        <div class="main">
            <div class="detalle">
                <h2><?php echo htmlspecialchars($row['nombre']); ?></h2>
                <div class="contenedorimagen">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagen']); ?>" alt="Imagen de <?php echo htmlspecialchars($row['nombre']); ?>">
                </div>
                <p><strong>Raza:</strong> <?php echo htmlspecialchars($row['raza']); ?></p>
                <p><strong>Edad:</strong> <?php echo htmlspecialchars($row['edad']); ?></p>
                <p><strong>Lugar:</strong> <?php echo htmlspecialchars($row['lugar']); ?></p>
                <p><strong>Descripción:</strong> <?php echo htmlspecialchars($row['descripcion']); ?></p>
                <p><strong>Recompensa:</strong> <?php echo htmlspecialchars($row['recompensa']); ?> $</p>

                <?php
                    $num=($row['numero']);
                ?>
            </div>
            
        </div>

        <div class="botones">
            <a class="bot" href="../detalles/guardar.php?id=<?php echo $row['ID'];?>&user=<?php echo $user_id; ?>"><button>GUARDAR</button></a> 

            <a class="bot" href="https://wa.me/<?php echo $num; ?>" target="_blank">
                <img src="../imagen/whatsapp.png" alt="Logotipo" width=5%>
            </a>
        </div>

        <div class="footer">

        </div>
    </div>
</body>
</html>
