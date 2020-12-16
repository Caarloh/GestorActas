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
}catch(Exception $e){

}