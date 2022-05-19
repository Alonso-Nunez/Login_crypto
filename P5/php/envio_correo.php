<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ('PHPMailer/Exception.php');
require ('PHPMailer/PHPMailer.php');
require ('PHPMailer/SMTP.php');
//datos que se reciben para enviar el correo de bienvenida
$email=$_POST['email'];
$usuario=$POST['username'];

enviarMail($email,$usuario);

function enviarMail($email, $usuario){        
    $email_user = "controlacceso.e1@gmail.com"; 
    $email_password = "UsoHash1"; 
    $the_subject = utf8_decode("Bienvenida");
    $address_to = $email;
    $from_name = utf8_decode("Tú página web de confianza");
    $phpmailer = new PHPMailer();
    try{
        $phpmailer->Username = $email_user;
        $phpmailer->Password = $email_password; 
        //-----------------------------------------------------------------
        // $phpmailer->SMTPDebug = 1;
        $phpmailer->SMTPSecure = 'ssl';
        $phpmailer->Host = "smtp.gmail.com"; // GMail
        $phpmailer->Port = 465;
        $phpmailer->IsSMTP(); // use SMTP
        $phpmailer->SMTPAuth = true;

        $phpmailer->setFrom($phpmailer->Username,$from_name);
        $phpmailer->AddAddress($address_to); // recipients email

        $phpmailer->Subject = $the_subject;	
        
        $phpmailer->Body .="<p>Gracias".$usuario."por registrarte en nuestra página web, te aseguramos que tu contraseña esta 100% segura, ya que se encuentra cifrada</p>";
        $phpmailer->Body .="<p>Fecha de envio: ".date("d-m-Y")."</p>";
        $phpmailer->Body .="<h5>Favor de no responder a este correo</h5>";
        $phpmailer->IsHTML(true);

        $phpmailer->Send();
        echo 'El mensaje se envió correctamente';
    }catch(Exception $e){
        echo "Mensaje no enviado($phpmailer->ErrorInfo)";
    }
}
?>