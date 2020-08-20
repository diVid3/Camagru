<?php

// TODO:  Could create non-clustered index on verify_hash

class Router {

  private $url;
  private $explodedUrl;

  private $route = '';
  private $action = 'show';
  private $id = '';

  function __construct($url) {
    
    $this->url = $url;

    $this->parse();
    $this->navigate();
  }

  private function navigate() {

    if (!$this->isValidAction($this->explodedUrl[1])) {
      return HttpResponseService::sendNotFound();
    }

    $routes = [
      '' => function() { new FeatureController($this->route, $this->action, $this->id); },
      'gallery' => function() { new FeatureController($this->route, $this->action, $this->id); },   // show (GET)
      'picture' => function() { new FeatureController($this->route, $this->action, $this->id); },   // show + id (GET)
      'capture' => function() { new FeatureController($this->route, $this->action, $this->id); },   // show (GET), create (POST)
      'register' => function() { new AuthController($this->route, $this->action, $this->id); },     // show (GET), create (POST)
      'login' => function() { new AuthController($this->route, $this->action, $this->id); },        // show (GET), create (POST)
      'verify' => function() { new AuthController($this->route, $this->action, $this->id); },       // edit + id (POST)
      'reset' => function() { new AuthController($this->route, $this->action, $this->id); },        // edit + id (POST)
      'settings' => function() { new AuthController($this->route, $this->action, $this->id); },     // show (GET), edit (POST)
      'accounts' => function() { new AccountController($this->route, $this->action, $this->id); },  // CRUD
      'pictures' => function() { new PictureController($this->route, $this->action, $this->id); },  // CRUD
      'comments' => function() { new CommentController($this->route, $this->action, $this->id); },  // CRUD
      'likers' => function() { new CommentController($this->route, $this->action, $this->id); }     // CRUD
    ];

    $chosenRoute = array_key_exists($this->route, $routes)
      ? $routes[$this->route]
      : false;

    if (!$chosenRoute) {
      return HttpResponseService::sendNotFound();
    }

    return $chosenRoute();
  }

  private function isValidAction($action) {

    if (
      $action === 'show' ||
      $action === 'create' ||
      $action === 'delete' ||
      $action === 'edit'
    ) {
      return true;
    }

    return false;
  }

  private function parse() {

    $this->url = rtrim($this->url, '/');
    $this->explodedUrl = explode('/', $this->url);
    $this->explodedUrlSize = count($this->explodedUrl);

    if ($this->explodedUrlSize > 3) {
      return HttpResponseService::sendNotFound();
    }

    $this->route = array_key_exists(0, $this->explodedUrl)
      ? $this->explodedUrl[0]
      : '';

    $this->action = array_key_exists(1, $this->explodedUrl)
      ? $this->explodedUrl[1]
      : 'show';

    $this->id = array_key_exists(2, $this->explodedUrl)
      ? $this->explodedUrl[2]
      : '';
  }
}

?>