<?php

session_start();

class AuthController extends Controller {

  function __construct($route, $action, $id) {
    
    if ($route === 'login' && $action === 'show') {

      parent::__construct('login');
      return;
    }

    if ($route === 'login' && $action === 'create') {

      $email = $_POST['email'];
      $password = $_POST['password'];

      $response = AuthService::login($email, $password);
      HttpResponseService::sendJson($response, 200);
      return;
    }

    if ($route === 'login' && $action === 'delete') {

      AuthService::logout();
      HttpResponseService::redirect('http://localhost:8080/gallery/show');
      return;
    }

    if ($route === 'register' && $action === 'show') {
      parent::__construct('register');
      return;
    }

    if ($route === 'register' && $action === 'create') {

      // TODO: Handle registration process here.
      // TODO: Send verification email.

      // TODO: Pull data from repository to check if username or email is taken.

      $response = [
        'success' => true,
        'message' => 'Check your inbox for a verification email'
      ];

      HttpResponseService::sendJson($response, 201);
      return;
    }

    if ($route === 'settings' && $action === 'show') {

      // TODO: Replace with the real repository values.

      $_SESSION['viewBag'] = [
        'username' => 'diVid3',
        'email' => 'genisevert7@gmail.com',
        'canNotify' => true
      ];

      parent::__construct('settings');
      return;
    }

    if ($route === 'settings' && $action === 'edit') {

      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $response = AuthService::editSettings($username, $email, $password);
      HttpResponseService::sendJson($response, 200);
      return;
    }
  }
}

?>