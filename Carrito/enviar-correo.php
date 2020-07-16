<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'database.php';

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



<div class="row">

        <?php
            $sentencia=$pdo->prepare("SELECT * FROM `tblproducots`");
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

        
        ?>

        <?php foreach($listaProductos as $producto){ ?>
            <div class="col-3">
                <div class="card">
                    <img
                    title="Mueble1" 
                    class="card-img-top" src="<?php echo $producto['Imagen'];?>" alt="Titulo" heigth="300px">
                    
                    <div class="card-body">
                        <span><?php echo $producto['Nombre'];?></span>
                        <h5 class="card-title">$<?php echo number_format($producto['Precio'],0) ;?></h5>
                        <p class="card-text">Mueble de tela de tigre del amazonas</p>
                        
                    <form action="" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
                    <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'],COD,KEY);?>">
                    <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'],COD,KEY);?>">
                    <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">
                        <button class="btn btn-primary" 
                            name="btnAccion"
                            value="Agregar"
                            type="submit">Agregar al carrito</button>
                    </form>

                    
                        
                    </div>

                </div>
            </div>

        <?php } ?>

       
        </div>