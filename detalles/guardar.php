<?php

include("../conexion.php");

$id = $_GET['id'];
$user_id = $_GET['user'];


$sql="INSERT INTO guardados (IDusuario,IDCartel) values ('$user_id','$id')";

if($conexion->query($sql)==TRUE){
    echo "<script type='text/javascript'>
    alert('¡Registro Exitoso!');
    window.history.back();
    </script>";
}





?>