<?php
namespace App\Core;


use PHPMailer\PHPMailer\PHPMailer;
use App\Models\User;

class Mailer
{
    public function sendMail($username,$email,$createAt){
        $mail = new PHPMailer();
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $createAt = $_POST['createdAt'];
        $cle = $createAt."_".$email;
        $cle = password_hash(($cle), PASSWORD_BCRYPT);
    
        $subject = 'Activer votre compte';
        $body = "Bienvenue sur VotreSite,". PHP_EOL; PHP_EOL."
        Pour activer votre compte, veuillez cliquer sur le lien ci-dessous".PHP_EOL."
        ou copier/coller dans votre navigateur Internet.".PHP_EOL."
        http://votresite.com/activation.php?log=".urlencode($username)."&cle=".urlencode($cle); PHP_EOL; PHP_EOL."
        --------------------".PHP_EOL."
        Ceci est un mail automatique, Merci de ne pas y répondre.";

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

    

    //smtp settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "mvccmswiki@gmail.com";
    $mail->Password = 'mvccmswiki42@';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  

    //email settings
    $mail->isHTML(true);
    $mail->setFrom($email, $username);
    $mail->addAddress("mvccmswiki@gmail.com");
    $mail->Subject = ("$email ($subject)");
    $mail->Body = $body;

    if($mail->send()){
        $status = "success";
        $response = "Email est envoyé!";
    }
    else
    {
        $status = "failed";
        $response = "Something is wrong: <br>" . $mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));

}
}
?>