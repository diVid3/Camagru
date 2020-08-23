<?php

class EmailService implements IEmailService {
  
  public static function sendVerifyMail($to, $verifyHash) {

    $subject = 'Camagru | Verification';
    $message = 'Thank you for signing up to Camagru! To complete your registration, just click on the following link to activate your account:
    ' . "http://localhost:8080/verify/edit/$verifyHash";

    $didSend = mail($to, $subject, $message);

    if (!$didSend) {
      throw new Exception('Couldn\'t send verification mail');
    }
  }
}

?>