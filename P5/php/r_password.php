<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ('PHPMailer/Exception.php');
require ('PHPMailer/PHPMailer.php');
require ('PHPMailer/SMTP.php');


$email=$_POST['email'];
//$email="alonsonunezvaz@gmail.com";
$temp_pass=genera_pass();

function genera_pass(){
    $cont="";
    $l=0;
   $var = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0","$",".","-","#","%","_","*"];
    //69 caracteres
   for($i=0;$i<8;$i++){
    $l=random_int(0,68);
    $cont.=$var[$l];
   }
   return $cont;
}

$contra=hash('md5',$temp_pass,false);
include_once('conexion.php');
$conexion=conn();
$sql="UPDATE usuarios SET password='$contra' WHERE email='$email'";
$resul=mysqli_query($conexion, $sql) or trigger_error("Query failed! SQL-Error: ".mysqli_error($conexion), E_USER_ERROR);

enviarMail($email,$temp_pass);

function enviarMail($email, $temp_pass){        
    $email_user = "controlacceso.e1@gmail.com"; 
    $email_password = "UsoHash1"; 
    $the_subject = utf8_decode("Reestablecimiento de contraseña");
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
        
        $phpmailer->Body .="<p>Su nueva contraseña temporal es la siguiente</p><h3>".$temp_pass."</h3><p>Cambia la contraseña en cuanto ingreses a tu cuenta</p>";
        $phpmailer->Body .="<p>Fecha de envio: ".date("d-m-Y")."</p>";
        $phpmailer->Body .="<h6>Favor de no responder a este correo</h6>";
        $phpmailer->IsHTML(true);

        $phpmailer->Send();
        echo 'El mensaje se envió correctamente';
    }catch(Exception $e){
        echo "Mensaje no enviado($phpmailer->ErrorInfo)";
    }
}

?>