<?php

ini_set('log_errors', 1);
ini_set('error_log', $_SERVER['DOCUMENT_ROOT'] . '/errors.log');
error_reporting(E_ALL);



// $DB_SERVER = "localhost";
// $DB_USER = "root";
// $DB_PASSWORD = "quackzor";
// $DB_DATABASE_NAME = "camagru";
// $DB_DSN = "mysql:host=$DB_SERVER";

// require_once('./config/database.php');



// ini_set('display_errors', 1);
// ini_set('log_errors', 1);
// ini_set('error_log', $_SERVER['DOCUMENT_ROOT'] . '/errors.log');
// error_reporting(E_ALL);

// require_once ('inc/errors.php');
// require_once ('config/database.php');

// function connectDBMS() {
//     global $DB_DSN;
//     global $DB_USER;
//     global $DB_PASSWORD;

//     try {
//         $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
//         $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         return ($PDO);
//     }
//     catch (PDOexception $e) {
//         error_log($e);
//     }
// }

// // Function concatenates a given string to the path to this script.
// // One can thus supply relative paths.
// function catPathToString($fileString) {
//     $URL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//     $arr = explode("/", $URL);
//     $arr = array_slice($arr, 0, sizeof($arr) - 1);
//     return (implode ("/", $arr) . '/' . $fileString);
// }

// require_once ('inc/errors.php');
// require_once ('config/database.php');
// require_once ('inc/connect.php');

// function createDB() {
//     global $DB_DATABASE_NAME;

//     try {
//         $PDO = connectDBMS();
//         $PDO->query("CREATE DATABASE IF NOT EXISTS $DB_DATABASE_NAME"); // Need to change my.cnf to support emoji's.
//         $PDO = NULL;
//     }
//     catch (PDOexception $e) {
//         error_log($e);
//     }
// }

// function createUserTable() {
//     global $DB_DATABASE_NAME;

//     $query1 = 'USE ' . $DB_DATABASE_NAME . ';';
//     $query2 = 'CREATE TABLE IF NOT EXISTS `users` (
//         `id` INT AUTO_INCREMENT PRIMARY KEY,
//         `username` VARCHAR(32) NOT NULL UNIQUE,
//         `password` VARCHAR(60) NOT NULL,
//         `email` VARCHAR(32) NOT NULL UNIQUE,
//         `notification` TINYINT(1) NOT NULL,
//         `verify_hash` VARCHAR(64) NOT NULL UNIQUE,
//         `reset_hash` VARCHAR(64) UNIQUE,
//         `verified` TINYINT(1) NOT NULL
//     );';
//     try {
//         $PDO = connectDBMS();
//         $PDO->query($query1);
//         $PDO->query($query2);
//         $PDO = NULL;
//     }
//     catch (PDOexception $e) {
//         error_log($e);
//     }
// }

// function createPictureTable() {
//     global $DB_DATABASE_NAME;

//     $query1 = 'USE ' . $DB_DATABASE_NAME . ';';
//     $query2 = 'CREATE TABLE IF NOT EXISTS `pictures` (
//         `id` INT AUTO_INCREMENT PRIMARY KEY,
//         `username` VARCHAR(32) NOT NULL,
//         `email` VARCHAR(32) NOT NULL,
//         `notification` TINYINT(1) NOT NULL,
//         `comments` LONGTEXT,
//         `likes` LONGTEXT,
//         `picture` LONGTEXT NOT NULL
//     );';
//     try {
//         $PDO = connectDBMS();
//         $PDO->query($query1);
//         $PDO->query($query2);
//         $PDO = NULL;
//     }
//     catch (PDOexception $e) {
//         error_log($e);
//     }
// }

// createDB();
// createUserTable();
// createPictureTable();



?>
