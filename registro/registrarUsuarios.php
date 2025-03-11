<?php
include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contraseña = $_POST["pass"];
    $contraseña2 = $_POST["confirmPassword"];
    
    $usuario = $_POST["username"];
    $respuesta = trim($_POST["pregunta"]); 
    $recaptchaResponse = $_POST["g-recaptcha-response"];

    
    if ($respuesta !== "g") { 
        echo "<script type='text/javascript'>
                alert('¡Respuesta incorrecta a la pregunta de seguridad!');
                window.location.href='../registro/registro3.php';
              </script>";
        exit();
    }

    
    $secretKey = "6LcBFsgqAAAAALqWbhdv_Ve7FO2vp5P_QpnBS73d"; 
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => $secretKey,
        'response' => $recaptchaResponse
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captchaSuccess = json_decode($verify);

    if (!$captchaSuccess->success) {
        echo "<script type='text/javascript'>
                alert('¡Error de verificación reCAPTCHA!');
                window.location.href='../registro/registro3.php';
              </script>";
        exit();
    }

   
    if (strlen($contraseña) >= 8 && preg_match('/[A-Z]/', $contraseña) && preg_match('/\d/', $contraseña)) {
        if ($contraseña == $contraseña2) {
                $sql = "SELECT * FROM usuarios WHERE Correo = '$correo'";
                $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                echo "El correo está registrado";
            } else {

                $contrahash=password_hash($contraseña, PASSWORD_DEFAULT);
                $sql2 = "INSERT INTO usuarios(Nombre,Correo,Contraseña,username) values ('$nombre','$correo','$contrahash','$usuario')";

                $num=0;

                $sql3="INSERT INTO codicoscambioc (codigo) values ('$num')";



                if ($conexion->query($sql2) == TRUE && $conexion->query($sql3) == TRUE) {
                    echo "<script type='text/javascript'>
                    alert('¡Registro Exitoso!');
                    window.location.href='../loguin/inicioSesion.php';
                    </script>";
                } else {
                    echo "Error al registrar el usuario: " . $conexion->error;
                }
            }
        } else {
            echo "<script type='text/javascript'>
                    alert('¡Las contraseñas no coinciden!');
                    window.location.href='registro3.php';
                    </script>";
        }
    } else {
        echo "<script type='text/javascript'>
                alert('Contraseña inválida. Debe tener al menos 8 caracteres, una mayúscula y un número.');
                window.location.href='registro3.php';
              </script>";
    }
}
?>
