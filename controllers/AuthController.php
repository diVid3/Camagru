<?php

class AuthController extends Controller {

  function __construct($route, $action, $id) {

    // GET
    if ($route === 'login' && $action === 'show') {

      AuthService::respondLoggedIn();

      parent::__construct('login');
      return;
    }

    // POST
    if ($route === 'login' && $action === 'create') {

      AuthService::respondLoggedIn();

      $email = $_POST['email'];
      $password = $_POST['password'];

      $response = AuthService::login($email, $password);
      HttpResponseService::sendJson($response, 200);
      return;
    }

    // GET
    if ($route === 'login' && $action === 'delete') {

      AuthService::logout();
      HttpResponseService::redirect('http://localhost:8080/gallery/show');
      return;
    }

    // GET
    if ($route === 'register' && $action === 'show') {

      AuthService::respondLoggedIn();

      parent::__construct('register');
      return;
    }

    // POST
    if ($route === 'register' && $action === 'create') {

      AuthService::respondLoggedIn();

      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $response = AuthService::register($username, $email, $password);

      HttpResponseService::sendJson($response, 201);
      return;
    }

    // GET
    if ($route === 'settings' && $action === 'show') {

      AuthService::respondNotLoggedIn();

      $email = $_SESSION['email'];

      try {

        $row = AccountRepository::getAccountByEmail($email);

      } catch (PDOException $e) {

        error_log($e);
        HttpResponseService::sendServerError();
      }

      $_SESSION['viewBag'] = [
        'username' => $row['username'],
        'email' => $row['email'],
        'canNotify' => $row['canNotify']
      ];

      parent::__construct('settings');
      return;
    }

    // POST
    if ($route === 'settings' && $action === 'edit') {

      AuthService::respondNotLoggedIn();

      $username = $_POST['username'];
      $password = $_POST['password'];
      $canNotify = $_POST['canNotify'];

      $response = AuthService::editSettings($username, $password, $canNotify);
      HttpResponseService::sendJson($response, 200);
      return;
    }

    // GET
    if ($route === 'verify' && $action === 'edit' && $id !== '') {

    }

    // GET
    if ($route === 'database' && $action === 'create') {

      require_once('./config/setup.php');
      HttpResponseService::sendEcho('Database created successfully!');
    }

    HttpResponseService::sendNotFound();
  }
}

?>