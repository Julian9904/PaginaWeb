<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


$nombre = $_POST['nombre'];
$email = $_POST['email'];
$msg = $_POST['msg'];

$asunto = "Contacto de" . $email;

$body = "Nombre: ". $nombre . "<br>Correo: " . $email . "<br>Mensaje: " . $msg;

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'muebleselangel2020@gmail.com';                     // SMTP username
    $mail->Password   = 'muebles2020';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('muebleselangel2020@gmail.com', 'Muebles el ángel');
    $mail->addAddress($email, $nombre);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $body;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<script>
        alert("Se ha suscrito satisfactoriamente");
        window.history.go(-1);
    </script>';
} catch (Exception $e) {
    echo "<script>
    alert('Ha ocurrido un error en la suscripción: {$mail->ErrorInfo}');
    
    window.history.go(-1); 
</script>";
        
    
}

?>



