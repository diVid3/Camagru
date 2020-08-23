<?php

interface IAuthService {

  public static function isLoggedIn();
  public static function login($email, $password);
  public static function logout();
  public static function register($username, $email, $password);
  public static function editSettings($username, $password, $canNotify);
  public static function respondLoggedIn();
  public static function respondNotLoggedIn();
}

?>