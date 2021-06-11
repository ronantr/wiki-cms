<?php

namespace App\Core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('vendor/autoload.php');

class Mailer
{
    public function sendMail($username, $email, $object, $body) {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true; 
            $mail->Username   = MAILUSER;
            $mail->Password   = MAILPWD; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            $mail->Port       = 465;  
            //Recipients
            $mail->setFrom('signup@wikicms.com', 'Wiki Signup');
            $mail->addAddress($email, "$username"); 

            //Content
            $mail->isHTML(true);
            $mail->Subject = $object;
            $mail->Body    = "$body";

            $mail->send();
            return;
        } catch (Exception $e) {
            return;
        }
    }
}