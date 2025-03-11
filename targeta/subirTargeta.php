<?php

include("../conexion.php");

$clave = getenv('admin123');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = $_POST["nombre"];
    $targeta = $_POST["numTargeta"];
    $fecha = $_POST["fecha"];
    $codigo = $_POST["numSeguridad"];


    $fecha_actual = date("Y-m-d");

    if(strlen($targeta)!=16){
        echo "<script type='text/javascript'>
                alert('¡Numero de tageta incorrecto');
                window.location.href='../targeta/targeta.php';
              </script>";
    }else{        
        if($fecha < $fecha_actual){
            echo "<script type='text/javascript'>
                alert('¡Targeta Vencida');
                window.location.href='../targeta/targeta.php';
              </script>";
        }else{
            if(strlen($codigo)!=3){
                echo "<script type='text/javascript'>
                alert('Codigo de seguridad incompleo');
                window.location.href='../targeta/targeta.php';
              </script>";
            }else{
                $sql="INSERT INTO targetas(nombre,numero,fecha,codigo) Values ('$nombre',AES_ENCRYPT('$targeta', '$clave'),'$fecha',AES_ENCRYPT('$codigo', '$clave'))";
                
                if($conexion->query($sql)==TRUE){
                    echo "<script type='text/javascript'>
                    alert('¡Registro Exitoso!');
                    window.location.href='../targeta/targeta.php';
                    </script>";

                }else{
                    echo "<script type='text/javascript'>
                    alert('¡Ubo un error en el registro, intentelo de nuevo!');
                    window.location.href='../targeta/targeta.php';
                    </script>";
                }
            }
        }        
    }

}
?>