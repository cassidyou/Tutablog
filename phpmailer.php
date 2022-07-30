<?php 

require_once 'includes/PHPMailer.php'; 
require_once 'includes/SMTP.php'; 
require_once 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);


try{
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = "smtp-relay.sendinblue.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = "oluchi.web@gmail.com";
    $mail->Password = "QXG1rF58LZqjs7pB";

    $mail->Subject = "Testing PHPMailer - Registration on tutablog website";
    $mail->setFrom("oluchi.web@gmail.com", "Tutablog");
    $mail->Body = "Your registration on tablog website was successful. Please find your login details below: \n
                  User is: username \n 
                  Password is: password \n
                  Best Regards \n
                  Oluchi Cassidy for tutablog";
    $mail->addAddress("oluchi.web@gmail.com");
    $mail->send();
    echo "Mail has been sent successfully";
}catch(Exception $e){
    echo "Mail could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>