<?php

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

    if (!$this->isValidAction($this->action)) {
      return HttpResponseService::sendNotFound();
    }

    $routes = [
      '' => function() { new FeatureController($this->route, $this->action, $this->id); },
      'gallery' => function() { new FeatureController($this->route, $this->action, $this->id); },
      'picture' => function() { new FeatureController($this->route, $this->action, $this->id); },
      'comment' => function() { new FeatureController($this->route, $this->action, $this->id); },
      'like' => function() { new FeatureController($this->route, $this->action, $this->id); },
      'capture' => function() { new FeatureController($this->route, $this->action, $this->id); },
      'register' => function() { new AuthController($this->route, $this->action, $this->id); },
      'login' => function() { new AuthController($this->route, $this->action, $this->id); },
      'verify' => function() { new AuthController($this->route, $this->action, $this->id); },
      'reset' => function() { new AuthController($this->route, $this->action, $this->id); },
      'database' => function() { new AuthController($this->route, $this->action, $this->id); },
      'settings' => function() { new AuthController($this->route, $this->action, $this->id); }
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
      : '';

    $this->id = array_key_exists(2, $this->explodedUrl)
      ? $this->explodedUrl[2]
      : '';

    if ($this->explodedUrlSize === 1 && $this->explodedUrl[0] === '') {

      $this->route = 'gallery';
      $this->action = 'show';
    }
  }
}

?>