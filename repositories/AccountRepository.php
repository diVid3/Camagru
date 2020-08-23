<?php

class AccountRepository implements IAccountRepository {

  // Only 1 write, no need for a transaction.
  public static function createAccount($username, $email, $passwordHash, $verifyHash) {

    $connection = Database::getConnection();

    $query = 'INSERT INTO Account (
      username,
      email,
      password,
      verifyHash,
      resetHash,
      canNotify
    ) VALUES (?, ?, ?, ?, ?, ?)';

    $statement = $connection->prepare($query);

    // Setting verifyHash to null since email doesn't work
    $verifyHash = null;

    $statement->execute([
      $username,
      $email,
      $passwordHash,
      $verifyHash,
      null,
      1
    ]);
  }

  public static function getAccountByUsername($username) {

    $connection = Database::getConnection();

    $query = 'SELECT * FROM Account WHERE username = ?';

    $statement = $connection->prepare($query);
    $statement->execute([$username]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    return $row;
  }

  public static function getAccountByEmail($email) {

    $connection = Database::getConnection();

    $query = 'SELECT * FROM Account WHERE email = ?';

    $statement = $connection->prepare($query);
    $statement->execute([$email]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    return $row;
  }

  public static function getAccountByResetHash($resetHash) {

    $connection = Database::getConnection();

    $query = 'SELECT * FROM Account WHERE resetHash = ?';

    $statement = $connection->prepare($query);
    $statement->execute([$resetHash]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    return $row;
  }

  public static function getAccountByEmailOrUsername($email, $username) {

    $connection = Database::getConnection();

    $query = 'SELECT * FROM Account WHERE email = ? OR username = ?';

    $statement = $connection->prepare($query);
    $statement->execute([$email, $username]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    return $row;
  }

  public static function editAccountByEmail($username, $email, $passwordHash, $canNotify) {

    if ($canNotify === false || $canNotify === 'false') {
      $canNotify = 0;
    }

    if ($canNotify === true || $canNotify === 'true') {
      $canNotify = 1;
    }

    $connection = Database::getConnection();

    $query = 'UPDATE Account SET username = ?, password = ?, canNotify = ? WHERE email = ?';

    $statement = $connection->prepare($query);

    $statement->execute([
      $username,
      $passwordHash,
      $canNotify,
      $email,
    ]);
  }

  public static function deleteAccountByEmail($email) {

    $connection = Database::getConnection();

    $query = 'DELETE FROM Account WHERE email = ?';

    $statement = $connection->prepare($query);
    $statement->execute([$email]);
  }
}

?>
