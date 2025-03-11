<?php


// Incluye los archivos de PHPMailer
include("../conexion.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];

    
    $sql = "SELECT ID FROM usuarios WHERE Correo = '$correo'";
    $result = $conexion->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idUsuario = $row["ID"]; // Guarda el ID del usuario encontrado

        $numeroAzar = rand(1000, 10000);

        // Guarda el código en la base de datos
        $sql2 = "UPDATE codicoscambioc SET codigo = '$numeroAzar' WHERE idusuario = '$idUsuario'";
        $result2=$conexion->query($sql2);

        if ($result2) {

            try {
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 2; // Habilita la salida de depuración detallada
    
                // Configuración SMTP de Gmail
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'jorgealbertocarranzavillanueva@gmail.com';  // Tu correo de Gmail
                $mail->Password   = 'ocia pcva hsmm kume';  // Contraseña de aplicación
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
    
                // Deshabilitar verificación SSL (solo para desarrollo)
                $mail->SMTPOptions = [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ],
                ];
    
                // Configuración del correo
                $mail->setFrom('SMP@gmail.com', name: 'SaveMyPet');
                $mail->addAddress($correo);
                $mail->Subject = "Codigo de verificacion";
                $mail->Body    = "Hola, este es tu codigo de recuperacion: $numeroAzar";
    
                // Envío del correo
                if ($mail->send()) {
                    session_start();
                          $_SESSION['correo'] = $correo;
                    echo "<script>
                            alert('¡Correo enviado con éxito!');
                            window.location.href='../cambioContraseña/ingresarCodigo.php';
                          </script>";

                          session_start();
                          $_SESSION['correo'] = $correo;
                } else {
                    echo "<script>alert('Error al enviar el correo.');window.location.href='../cambioContraseña/cambio.php';</script>";
                }
            } catch (Exception $e) {
                
                echo "<script>alert('Error al enviar el correo: {$mail->ErrorInfo}');window.location.href='../cambioContraseña/cambio.php';</script>";
            }
    
    
    

        }

        
        



    } else {
        echo "<script>alert('El correo no está registrado.');window.location.href='../cambioContraseña/cambio.php';</script>";
    }
}
?>