<?php

interface IAuthService {

  public static function isLoggedIn();
  public static function login($email, $password);
  public static function logout();
  public static function editSettings($username, $email, $password);
}

?>