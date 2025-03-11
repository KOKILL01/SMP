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
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveMyPet</title>
    <link rel="icon" type="image/png" href="../imagen/amor.png">
    <link rel="stylesheet" href="../guardados/guardados3.css">
</head>
<body>
        <div class="header">
            <img src="../imagen/amor.png" alt="Logotipo" width=5%>
            <h1>SMP</h1>
            
            <a class="debut" href="../index/index2.php"><button class="but"><img src="../imagen/casap.png" alt="Logotipo" width=50%></button></a>
        </div>
    <div class="page">
        

        <div class="main">
            <div class="contenedor">
                <?php
                $query = "SELECT * FROM  carteles WHERE ID IN (SELECT IDCartel FROM guardados where IDusuario=$user_id)";
                $resultado = mysqli_query($conexion, $query);

                while ($row = mysqli_fetch_assoc($resultado)) {
                    $nombre = $row['nombre'];
                    $raza = $row['raza'];
                    $edad = $row['edad'];
                    $lugar = $row['lugar'];
                    $descripcion = $row['descripcion'];
                    $recompensa = $row['recompensa'];
                    $id = $row['ID'];
                    $imagen = base64_encode($row['imagen']);
                    echo "<a href='../detalles/detalle.php?id=$id' class='cont2'>";
                    echo "<div class='cartel'>";
                    echo "<h2>$nombre</h2>";
                    echo "<img src='data:image/jpeg;base64,$imagen' alt='Imagen de $nombre'>";
                    echo "<p>Raza: $raza</p>";
                    echo "<p>Lugar: $lugar</p>";
                    echo "<p>Recompensa: $recompensa</p>";
                    echo "</a>";
                    echo "</div>";
                }
                ?>
            </div>

            <div class="sidebar">
                <h2 class="tsidebar">Mascotitas</h2>
                <img id="dogImage" src="" alt="Perro Aleatorio" width="300" class="fotoapi">
                <div id="contenido"></div>
                <button onclick="loadDog()" class="botonapi" id="cargarBtn">Ver mas</button>
                <script>
                    function loadDog() {
                        fetch('https://dog.ceo/api/breeds/image/random')
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('dogImage').src = data.message;
                            })
                            .catch(error => console.error('Error:', error));
                    }
                    loadDog();
                </script>
            </div>
        </div>

        <div class="footer">
            <p>Todos los derechos</p>
        </div>
    </div>
    <script src="../javas/mensaje.js"></script>
</body>
</html>