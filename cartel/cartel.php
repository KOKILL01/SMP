<?php
session_start();

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
    <title>Publicar Cartel</title>

    <link rel="stylesheet" href="cartel4.css">
</head>

<body>
    <div class="box">
        <div class="header">

            <div class="icono">
                <img src="../imagen/amor.png" alt="Logotipo" width="25%">
            </div>

            <div class="titulo">
                <h1>SMP</h1>
            </div>

            <div class="botones">
            <a class="debut" href="../index/index2.php"><button class="but"><img src="../imagen/casap.png" alt="Logotipo" width=50%></button></a>
            </div>

        </div>
        <div class="page">
            <div class="formulario">
                <form action="../cartel/registrarCartel.php" method="post" enctype="multipart/form-data">
                    <h1>Publica tu mascota</h1>

                    <p>Nombre de tu mascota: *</p>
                    <input type="text" required name="nombre" placeholder="Nombre mascota: ">

                    <p>Tipo de mascota: *</p>
                    <input type="text" required name="raza" placeholder="'Perro','Gato',etc..."> <br>

                    <p>Edad: *</p>
                    <input type="number" required name="edad">


                    <p>Publica una foto: *</p>
                    <input type="file" accept="image/*" required name="foto">

                    <p>Donde se perdio?: *</p>
                    <input type="text" required name="perdio" placeholder="Minicipio,Colonia, calle....">

                    <p>Alguna descripcion que ayude a encontrarlo: *</p>
                    <input type="text" required name="descripcion" id="descripcion">
                    <span id="descripcionError" class="error"></span><br>
                    <div class="progress-container">
                        <div id="progress-bar"></div>
                    </div>

                    <p>Recompensa?: *</p>
                    <input type="number" required name="dinero">

                    <p>Numero para contactarte: *</p>
                    <input type="number" required name="numero" placeholder="449 *** ****">



                    <input type="submit" value="publicar">
                </form>

                <a href="../index/index2.php">Cancelar</a> <br>
            </div>

            <div class="mios">
                <h2>Mis carteles</h2>
                <div class="cartelito">
                    <div class="cajas">

                    <?php
                        $query = "SELECT * FROM carteles WHERE idusuario=$user_id";
                        $resultado = mysqli_query($conexion, $query);

                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $nombre = $row['nombre'];
                            $recompensa = $row['recompensa'];
                            $id = $row['ID'];
                            
                            $imagen = base64_encode($row['imagen']);

                            echo "<div class='infocaja'>";
                                echo "<img class='imgc' src='data:image/jpeg;base64,$imagen' alt='Imagen de $nombre'>";
                                echo "<p>$nombre</p>";
                                echo "<p>$ $recompensa</p>";
                                echo "</div>";

                                echo "<div class='cajaboton'>";
                                echo "<button class='but' id='butonOver'>eliminar</button>";
                            echo "</div><br>"; 
                            
                        }
                        ?>




                    </div>
                </div>

            </div>

        </div>
    </div>
    <script src="../javas/texto.js"></script>
    <script src="../javas/cursorhover.js"></script>
</body>

</html>