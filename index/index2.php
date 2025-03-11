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
    <link rel="stylesheet" href="../index/index5.css">
    <title>Document</title>
</head>

<body>
    <div class="page" id="mb">

        <!-------------------------------------header------------------------------------->
        <div class="header" >

            <div class="icono">
                <img src="../imagen/amor.png" alt="Logotipo" width="25%">
            </div>

            <div class="titulo">
                <h1>svp vienvenido usuario numero <?php echo $user_id; ?></h1>
            </div>

            <div class="botones">
                <a class="debut" href="../cartel/cartel.php"><button class="but">Publicar Cartel</button></a>
                <a class="debut" href="../guardados/guardados.php"><button class="but">Guardados</button></a>
                <a class="debut" href="../CambiarDatos/datos.php"><button class="but">Mis datos</button></a>
                <a class="debut" href="../targeta/targeta.php"><button class="but">Dar alta targeta</button></a>
            </div>

        </div>
        <!--header-->


        <!------------------------filtro--------------------------------------->
        <div class="filtro">


            <form method="GET" action="" id="box">
                <select name="raza">
                    <option value="">Selecciona tipo de mascota</option>
                    <?php
                    
                    $query_r = "SELECT DISTINCT raza FROM carteles ORDER BY raza ASC";
                    $resultado_r = mysqli_query($conexion, $query_r);

                    while ($row = mysqli_fetch_assoc($resultado_r)) {
                        $raza = $row['raza'];
                        $selected = (isset($_GET['raza']) && $_GET['raza'] == $raza) ? 'selected' : '';
                        echo "<option value='$raza' $selected>$raza</option>";
                    }
                    ?>
                </select>

                <select name="edad">
                    <option value="">Selecciona la edad</option>
                    <?php
                    $query_e = "SELECT DISTINCT edad FROM carteles ORDER BY edad ASC";
                    $resultado_e = mysqli_query($conexion, $query_e);

                    while ($row = mysqli_fetch_assoc($resultado_e)) {
                        $edad = $row['edad'];
                        $selected = (isset($_GET['edad']) && $_GET['edad'] == $edad) ? 'selected' : '';
                        echo "<option value='$edad' $selected>$edad</option>";
                    }
                    ?>
                </select>

                <select name="lugar">
                    <option value="">Selecciona el lugar</option>
                    <?php
                    $query_l = "SELECT DISTINCT lugar FROM carteles ORDER BY lugar ASC";
                    $resultado_l = mysqli_query($conexion, $query_l);

                    while ($row = mysqli_fetch_assoc($resultado_l)) {
                        $lugar = $row['lugar'];
                        $selected = (isset($_GET['lugar']) && $_GET['lugar'] == $lugar) ? 'selected' : '';
                        echo "<option value='$lugar' $selected>$lugar</option>";
                    }
                    ?>
                </select>

                <input type="number" name="recompensa_min" placeholder="Recompensa mínima">
                <input type="number" name="recompensa_max" placeholder="Recompensa máxima">
                <button type="submit">Filtrar</button>
            </form>
            <button onclick="fadeIn()" id="m">Mostrar filtro</button>
            <button onclick="fadeOut()" id="o">Ocultar filtros</button>

        </div>

        <!-------------------------------main-------------------------------->

        <div class="main" id="colorBox">

            <?php
            $query = "SELECT * FROM carteles WHERE 1=1";

            if (!empty($_GET['raza'])) {
                $raza = $_GET['raza'];
                $query .= " AND raza = '$raza'";
            }

            if (!empty($_GET['edad'])) {
                $edad = $_GET['edad'];
                $query .= " AND edad = '$edad'";
            }

            if (!empty($_GET['lugar'])) {
                $lugar = $_GET['lugar'];
                $query .= " AND lugar LIKE '%$lugar%'";
            }

            if (!empty($_GET['recompensa_min'])) {
                $recompensa_min = $_GET['recompensa_min'];
                $query .= " AND recompensa >= '$recompensa_min'";
            }

            if (!empty($_GET['recompensa_max'])) {
                $recompensa_max = $_GET['recompensa_max'];
                $query .= " AND recompensa <= '$recompensa_max'";
            }

            $resultado = mysqli_query($conexion, $query);

            echo "<div class='contenedor' >";
            while ($row = mysqli_fetch_assoc($resultado)) {
                $nombre = $row['nombre'];
                $raza = $row['raza'];
                $edad = $row['edad'];
                $lugar = $row['lugar'];
                $descripcion = $row['descripcion'];
                $recompensa = $row['recompensa'];
                $imagen = base64_encode($row['imagen']);
                $id = $row['ID'];

                echo "<a href='../detalles/detalle.php?id=$id' class='cont2'>";
                echo "<div class='cartel'>";

                echo "<div class='nombrec'>";
                echo "<h2>$nombre</h2>";
                echo "</div>";

                echo "<div class='imagenc'>";
                echo "<img src='data:image/jpeg;base64,$imagen' alt='Imagen de $nombre'>";
                echo "</div>";

                echo "<div class='infoc'>";
                echo "<p>Tipo: $raza</p>";
                echo "<p>Lugar: $lugar</p>";
                echo "<p>Recompensa: $recompensa</p>";
                echo "</div>";

                echo "</div>";
                echo "</a>";
            }
            echo "</div>";
            ?>

            <!-------------------- sidebar ------------------>
            <div class="sidebar">
            <h3>Mayores Recompensas</h3>
                <div class="carrucel">
                    
                    <?php
                    $query2 = "SELECT * FROM carteles ORDER BY recompensa DESC LIMIT 3";
                    $resultado2 = mysqli_query($conexion, $query2);

                    if (!$resultado2) {
                        die("Error en la consulta: " . mysqli_error($conexion));
                    }

                    $i = 0;
                    echo "<div class='contenedor2c'>";
                    while ($row = mysqli_fetch_assoc($resultado2)) {
                        $nombre = $row['nombre'];
                        $raza = $row['raza'];
                        $edad = $row['edad'];
                        $lugar = $row['lugar'];
                        $descripcion = $row['descripcion'];
                        $recompensa = $row['recompensa'];
                        $imagen = base64_encode($row['imagen']);
                        $id = $row['ID'];
                        $activeClass = ($i === 0) ? "active" : "";

                        echo "<a href='../detalles/detalle.php?id=$id' class='cont2'>";
                            echo "<div class='cartel2a $activeClass'>";

                                echo "<div class='nombrec'>";
                                echo "<h2>$nombre</h2>";
                                echo "</div>";

                                echo "<div class='imagenc2'>";
                                echo "<img class='image2' src='data:image/jpeg;base64,$imagen' alt='Imagen de $nombre'>";
                                echo "</div>";

                                echo "<div class='infoc'>";
                                echo "<p>Tipo: $raza</p>";
                                echo "<p>Lugar: $lugar</p>";
                                echo "<p>Recompensa: $recompensa</p>";
                                echo "</div>";

                            echo "</div>";
                        echo "</a>";
                    }
                    echo "</div>";
                    ?>
                </div>

                <div class="cartel2">
                    <div class="nombrec">
                        <h2>Mascotitas:</h2>
                    </div>
                    <div class="imagenc">
                        <img id="dogImage" src="" alt="Perro Aleatorio" width="300" class="fotoapi">
                        <div id="contenido"></div>
                    </div>
                    <div class="infoc">
                        <button onclick="loadDog()" class="botonapi" id="cargarBtn">Ver más</button>
                    </div>

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
        </div>

    </div>

    <div class="footer">
        <p>Todos los derechos reservados</p>
    </div>
    <script src="../javas/carrucel.js"></script>                    
    <script src="../javas/mensaje.js"></script>
    <script src="../javas/colorScroll.js"></script>
    <script src="../javas/ocultar.js"></script>
    
    <script src="../javas/cursorhover.js"></script>
</body>

</html>
