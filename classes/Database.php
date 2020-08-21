<?php

require_once('./config/database.php');

class Database implements IDatabase {

  private static $connection = null;

  public static function getConnection() {

    global $DB_SERVER;
    global $DB_USER;
    global $DB_PASSWORD;
    global $DB_DATABASE_NAME;
    global $DB_DSN;

    if (self::$connection === null) {

      // TODO: Create PDO connection here (if it doesn't exist), return it.

      //       try {
      //     $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      //     $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //     return ($PDO);
      // }
      // catch (PDOexception $e) {
      //     error_log($e);
      // }
      // }

      // $DB_SERVER = "localhost";
      // $DB_USER = "root";
      // $DB_PASSWORD = "quackzor";
      // $DB_DATABASE_NAME = "camagru";
      // $DB_DSN = "mysql:host=$DB_SERVER";

      try {

        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        self::$connection = $PDO;

      } catch(PDOException $e) {

        error_log($e);
        HttpResponseService::sendServerError();
      }
    }

    return self::$connection;
  }

  public static function createDatabase() {

    global $DB_DATABASE_NAME;

    try {

      // $PDO = connectDBMS();
      // $PDO->query("CREATE DATABASE IF NOT EXISTS $DB_DATABASE_NAME"); // Need to change my.cnf to support emoji's.
      // $PDO = NULL;

      $connection = self::getConnection();
      $connection->query("CREATE DATABASE IF NOT EXISTS $DB_DATABASE_NAME;");


    } catch(PDOexception $e) {

      error_log($e);
      HttpResponseService::sendServerError();
    }
  }
}

?>
