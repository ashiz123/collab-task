<?php

namespace config;

use models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use utils\Logger;

// require 'vendor/autoload.php'; 


class smtpMailer{
 private $mail;


 public function __construct()
 {
    $this->mail = new PHPMailer(true);
    $this->mail->isSMTP();
    $this->mail->Host = 'sandbox.smtp.mailtrap.io'; 
    $this->mail->SMTPAuth = true;
    $this->mail->Username = '5b6ff6690e5a80'; 
    $this->mail->Password = 'e1ef0f2ed7b854'; 
    $this->mail->SMTPSecure = 'tls'; 
    $this->mail->Port = 587;
 }


 public function sendOtpToEmail($to, $subject, $message) {
    try {
        // Email details
        $this->mail->setFrom('ashizhamal@gmail.com', 'add-todo');
        $this->mail->addAddress($to);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;

        $this->mail->send();
        return true;
    } catch (Exception $e) {
        Logger::error($e->getMessage());
        return false;
    }
}





}


?>




<!-- $email = 'thakurisukmita@gmail.com'; // Recipient email address
$subject = 'Test Email from Mailtrap';
$message = 'This is a test email sent via Mailtrap and PHPMailer.';

echo sendEmail($email, $subject, $message); -->


