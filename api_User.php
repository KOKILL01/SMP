<?php
header('Content-Type: application/json');
include("conexion.php");
if ($conexion->connect_error) {
    die(json_encode(["error" => "Conexión fallida: " . $conexion->connect_error]));
}
$username = $_GET['username'];
$sql = "SELECT * FROM usuarios WHERE username = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo json_encode(["disponible" => false]); 
} else {
    echo json_encode(["disponible" => true]); 
}
$stmt->close();
$conexion->close();
?>