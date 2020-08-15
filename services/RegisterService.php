<?php

class RegisterService implements IRegisterService {

  private static function isIdentifiersTaken($username, $email) {

    // TODO:  Check use repository to fetch by email and if it doesn't
    //        exist, it's good to go,
  }

  public static function register($username, $email, $password) {

    if (!self::isIdentifiersTaken($username, $email)) {
      // TODO: Use repository to create user.
    }
  }
}

?>