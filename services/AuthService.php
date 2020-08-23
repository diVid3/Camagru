<?php

class AuthService implements IAuthService {

  private static function isIdentifiersTaken($username, $email) {

    try {

      $row = AccountRepository::getAccountByEmailOrUsername($email, $username);

    } catch(PDOException $e) {

      error_log($e);
      HttpResponseService::sendServerError();
    }

    if ($row !== false) {
      return true;
    }

    return false;
  }

  public static function isLoggedIn() {

    if (array_key_exists('loggedin', $_SESSION)) {
      return $_SESSION['loggedin'];
    }

    return false;
  }

  public static function login($email, $password) {

    try {

      $row = AccountRepository::getAccountByEmail($email);

    } catch(PDOException $e) {

      error_log($e);
      HttpResponseService::sendServerError();
    }

    $userId = $row['id'];
    $username = $row['username'];
    $verifyHash = $row['verifyHash'];
    $userPasswordHash = $row['password'];

    if ($row === false || password_verify($password, $userPasswordHash) === false) {

      return [
        'success' => false,
        'message' => 'Email or password is incorrect'
      ];
    }

    if ($verifyHash !== null) {

      return [
        'success' => false,
        'message' => 'You need to verify your account'
      ];
    }

    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $userId;
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $username;

    return [
      'success' => true,
      'message' => 'Logged in'
    ];
  }

  public static function logout() {

    unset($_SESSION['loggedin']);
    unset($_SESSION['email']);
    unset($_SESSION['username']);
  }

  public static function register($username, $email, $password) {

    try {

      $response = Validation::isValidRegistration($username, $email, $password);

      if ($response['success'] === false) {
        return $response;
      }

    } catch (Exception $e) {

      error_log($e);
      HttpResponseService::sendServerError();
    }

    if (self::isIdentifiersTaken($username, $email)) {

      return [
        'success' => false,
        'message' => 'User already exists'
      ];
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $verifyHash = bin2hex(random_bytes(32));

    try {

      // Had to disable the email service due to locked system configuration.
      // EmailService::sendVerifyMail($email, $verifyHash);
      AccountRepository::createAccount($username, $email, $passwordHash, $verifyHash);

    } catch(PDOException | Exception $e) {

      error_log($e);
      HttpResponseService::sendServerError();
    }

    return [
      'success' => true,
      'message' => 'Check your email for a verfication request'
    ];
  }

  public static function editSettings($username, $password, $canNotify) {

    try {

      $response = Validation::isValidSettingsEdit($username, $password);

      if ($response['success'] === false) {
        return $response;
      }

    } catch (Exception $e) {

      error_log($e);
      HttpResponseService::sendServerError();
    }

    $sessionUsername = $_SESSION['username'];
    $sessionEmail = $_SESSION['email'];
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    if ($sessionUsername === $username) {
      $username = $sessionUsername;
    }

    try {

      AccountRepository::editAccountByEmail($username, $sessionEmail, $passwordHash, $canNotify);

    } catch(PDOException | Exception $e) {

      error_log($e);
      HttpResponseService::sendServerError();
    }

    return [
      'success' => true,
      'message' => 'Settings changed'
    ];
  }

  public static function respondLoggedIn() {

    if (self::isLoggedIn()) {

      HttpResponseService::sendUnauthorized();
      return;
    }
  }

  public static function respondNotLoggedIn() {

    if (!self::isLoggedIn()) {

      HttpResponseService::sendUnauthorized();
      return;
    }
  }
}

?>