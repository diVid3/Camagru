<?php

interface IEmailService {

  public static function sendVerifyMail($to, $verifyHash);
}

?>