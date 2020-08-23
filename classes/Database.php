<?php

require_once('./config/database.php');

class Database implements IDatabase {

  private static $connection = null;

  public static function getConnection() {

    global $DB_USER;
    global $DB_PASSWORD;
    global $DB_DSN;
    global $DB_DATABASE_NAME;

    if (self::$connection === null) {

      try {

        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $PDO->query("Use $DB_DATABASE_NAME;");

        self::$connection = $PDO;

      } catch(PDOException $e) {

        error_log($e);
        HttpResponseService::sendServerError();
      }
    }

    return self::$connection;
  }

  public static function createDatabase() {

    global $DB_USER;
    global $DB_PASSWORD;
    global $DB_DSN;
    global $DB_DATABASE_NAME;

    $query1 = "CREATE DATABASE $DB_DATABASE_NAME;";

    $query2 = "USE $DB_DATABASE_NAME;";

    $query3 = 'CREATE TABLE Account(
      id INT AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(64) NOT NULL UNIQUE,
      email VARCHAR(64) NOT NULL UNIQUE,
      password VARCHAR(64) NOT NULL,
      verifyHash VARCHAR(64) UNIQUE,
      resetHash VARCHAR(64) UNIQUE,
      canNotify TINYINT(1) NOT NULL
    );';

    $query4 = 'CREATE TABLE Picture(
      id INT AUTO_INCREMENT PRIMARY KEY,
      accountId INT NOT NULL,
      path VARCHAR(64) NOT NULL,
      FOREIGN KEY (accountId)
        REFERENCES Account(id)
        ON DELETE CASCADE
    );';

    $query5 = 'CREATE TABLE Comment(
      id INT AUTO_INCREMENT PRIMARY KEY,
      accountId INT NOT NULL,
      pictureId INT NOT NULL,
      text TEXT NOT NULL,
      FOREIGN KEY (accountId)
        REFERENCES Account(id)
        ON DELETE CASCADE,
      FOREIGN KEY (pictureId)
        REFERENCES Picture(id)
        ON DELETE CASCADE
    );';

    $query6 = 'CREATE TABLE Liker(
      id INT AUTO_INCREMENT PRIMARY KEY,
      accountId INT NOT NULL,
      pictureId INT NOT NULL,
      FOREIGN KEY (accountId)
        REFERENCES Account(id)
        ON DELETE CASCADE,
      FOREIGN KEY (pictureId)
        REFERENCES Picture(id)
        ON DELETE CASCADE
    );';

    try {

      $connection = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $connection->beginTransaction();
      $connection->query($query1);
      $connection->query($query2);
      $connection->query($query3);
      $connection->query($query4);
      $connection->query($query5);
      $connection->query($query6);
      $connection->commit();

    } catch(PDOexception $e) {

      $connection->rollBack();
      error_log($e);
      HttpResponseService::sendEcho('Couldn\'t create the database, sorry!');
    }
  }
}

?>
