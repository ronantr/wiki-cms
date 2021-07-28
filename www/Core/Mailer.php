<?php

namespace App\Core;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use App\Models\User;

require 'PHPMailer/PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer/PHPMailer.php';
require 'PHPMailer/PHPMailer/SMTP.php';

class Mailer
{
    public function sendMail($email)
    {



        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 15; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        $mail = new PHPMailer();
        $email = $_POST['email'];
        // randomly generated string
        $password = uniqid(mt_rand(), true);
        $cle = password_hash(($randomString), PASSWORD_BCRYPT);
        //smtp settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "locacarverify@gmail.com";
        $mail->Password = 'weopbtpgeftfvvuc';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //email settings
        $mail->isHTML(true);
        $mail->setFrom("locacarverify@gmail.com");
        $mail->addAddress($email);


        $subject = 'Mot de passe CMS';
        $body = "Bienvenue sur cms,</br>";
        $body .= "</br>";
        $body .= "Le mot de passe de votre compte a bien &eacute;t&eacute; modifi&eacute;. Votre mot de passe est ci-dessous </br>";
        $body .= "Votre nouveau mot de passe : " . $randomString;
        $body .= '</br>';
        $body .= '</br>             ';
        $body .= "-------------------- </br>";
        $body .= "Ceci est un mail automatique, Merci de ne pas y r&eacute;pondre.";
        $mail->Subject = $subject;
        $mail->Body = $body;

        if ($mail->send()) {
            $user = new User;
            $user->ModificationUser($email, $cle);
            $user->VerifUser($email);
            echo ('test');
            return true;
        } else {
            $status = "failed";
            $response = "Something is wrong: <br>" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
    }
}
