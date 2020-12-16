<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
	);
    //Server settings
    $mail->SMTPDebug = 0;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                 
    $mail->SMTPAuth   = true;                                 
    $mail->Username   = 'pollorobot2020@gmail.com';                     //correo que envia el mail (hice un correo de ejemplo)
    $mail->Password   = 'PolloRobot_2020';                               // contraseña del correo
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
    $mail->Port       = 587;                                   

    //Recipients
    $mail->setFrom('pollorobot2020@gmail.com', 'PolloRobot');   
    $mail->addAddress('j.pablo.velasc@gmail.com', 'Carlos');     //Destinatario
    //$mail->addReplyTo('info@example.com', 'Information');  para replicar

    //$mail->addCC('cc@example.com');

    //$mail->addBCC('bcc@example.com');

    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // permite agregar una imagen

    //Contenido del correo
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Bienvenido a PolloRobot';
    $mail->Body    = 'Has recibido una invitacion de proyecto en PolloRobot!';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Mensaje enviado con exito';
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}