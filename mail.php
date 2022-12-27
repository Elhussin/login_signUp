<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'phpMiler/autoload.php';



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer();



    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;       لاخفاء واظهار بيانات  الارسال                 //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'taha2282015@gmail.com';                     //SMTP username
    $mail->Password   = '0108704401';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
   //Content
   $mail->isHTML(true);
   $mail->CharSet="UTF-8"; //  لدعم اللغه العربيه

?>
