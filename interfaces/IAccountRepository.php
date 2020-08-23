<?php

interface IAccountRepository {

  public static function createAccount($username, $email, $passwordHash, $verifyHash);
  public static function getAccountByUsername($username);
  public static function getAccountByEmail($email);
  public static function getAccountByResetHash($resetHash);
  public static function getAccountByEmailOrUsername($email, $username);
  public static function editAccountByEmail($username, $email, $passwordHash, $canNotify);
  public static function deleteAccountByEmail($email);
}

?>
