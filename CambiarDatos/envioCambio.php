<?php
session_start(); // Iniciar sesión
include("../conexion.php"); // Incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = trim($_POST["nombre"]); // Eliminar espacios en blanco
    $correo = trim($_POST["correo"]); // Eliminar espacios en blanco
    $usuario = trim($_POST["username"]); // Eliminar espacios en blanco

    // Array para almacenar las partes de la consulta SQL
    $updates = [];

    // Verificar y agregar cada campo al array si no está vacío
    if (!empty($nombre)) {
        $updates[] = "Nombre = '$nombre'";
    }
    if (!empty($correo)) {
        $updates[] = "Correo = '$correo'";
    }
    if (!empty($usuario)) {
        $updates[] = "username = '$usuario'";
    }

    // Si hay campos para actualizar
    if (!empty($updates)) {
        // Construir la consulta SQL dinámicamente
        $sql = "UPDATE usuarios SET " . implode(", ", $updates) . " WHERE ID = {$_SESSION['user_id']}";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            echo "<script type='text/javascript'>
                    alert('¡Datos actualizados correctamente!');
                    window.history.back();
                  </script>";
            exit();
        } else {
            echo "<script type='text/javascript'>
                    alert('¡Ocurrió un error, inténtalo de nuevo!');
                    window.history.back();
                  </script>";
            exit();
        }
    } else {
        // Si no se proporcionaron datos para actualizar
        echo "<script type='text/javascript'>
                alert('¡No se proporcionaron datos para actualizar!');
                window.history.back();
              </script>";
        exit();
    }
}
?>