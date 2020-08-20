<?php

session_start();

class AuthService implements IAuthService {

  public static function isLoggedIn() {

    if (array_key_exists('loggedin', $_SESSION)) {
      return $_SESSION['loggedin'];
    }

    return false;
  }

  public static function login($email, $password) {

    // TODO:  Fetch account by email from repository
    //        encrypt password
    //        if password match account password, in session, set 'loggedin' to true and 'email' to $email.

    // TODO:  Remember to check if the user logging in is verified.

    $response = [
      'success' => false,
      'message' => 'Email or password is incorrect'
    ];

    if ($email === 'genisevert7@gmail.com' && $password === 'quack') {

      // TODO: Check if email / account exists, if it does, check if passwords match, if not in both, send
      // back the above message.

      $_SESSION['loggedin'] = true;
      $_SESSION['email'] = $email;

      $response['success'] = true;
      $response['message'] = 'Logged in';
    }

    return $response;
  }

  public static function logout() {

    unset($_SESSION['loggedin']);
    unset($_SESSION['email']);
  }

  public static function editSettings($username, $email, $password) {

    // $response = [
    //   'success' => false,
    //   'message' => 'Oops, something went wrong'
    // ];

    // TODO:  If it's a password reset, send reset email containing the reset hash.
    //        If it's a email change, generate verification hash + send verify email to new
    //        account + log the user out.

    $response = [
      'success' => true,
      'message' => 'Settings changed'
    ];

    return $response;
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