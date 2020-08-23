<?php

class Validation {

  public static function isValidUsername($username) {

    $result = preg_match('/^\w{5,}$/', $username);

    if ($result === false) {
      throw new Exception('Couldn\'t preg_match username');
    }

    return $result;
  }

  public static function isValidEmail($email) {

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
    }

    return true;
  }

  public static function isValidPassword($password) {

    $result = preg_match('/^[a-zA-Z0-9!@#$%^&*]{5,}$/', $password);

    if ($result === false) {
      throw new Exception('Couldn\'t preg_match password');
    }

    return $result;
  }

  public static function isValidRegistration($username, $email, $password) {

    if (!self::isValidUsername($username)) {

      return [
        'success' => false,
        'message' => 'Only normal characters allowed, minimum length of 5'
      ];
    }

    if (!self::isValidEmail($email)) {

      return [
        'success' => false,
        'message' => 'Your email is incorrect'
      ];
    }

    if (!self::isValidPassword($password)) {

      return [
        'success' => false,
        'message' => 'Use at least uppercase, lowercase, numbers, and special characters, minimum length of 5'
      ];
    }

    return [
      'success' => true
    ];
  }

  public static function isValidSettingsEdit($username, $password) {

    if (!self::isValidUsername($username)) {

      return [
        'success' => false,
        'message' => 'Only normal characters allowed, minimum length of 5'
      ];
    }

    if (!self::isValidPassword($password)) {

      return [
        'success' => false,
        'message' => 'Use at least uppercase, lowercase, numbers, and special characters, minimum length of 5'
      ];
    }

    return [
      'success' => true
    ];
  }
}

?>
