<?php

class FeatureController extends Controller {

  function __construct($route, $action, $id) {

    if ($route === 'gallery' && $action === 'show') {

      parent::__construct('gallery');
      return;
    }

    if ($route === 'picture' && $action === 'show' && $id !== '') {

      AuthService::respondNotLoggedIn();

      // TODO: Fetch the picture by id and it's comments and likes.

      parent::__construct('picture');
      return;
    }

    if ($route === 'capture' && $action === 'show') {

      AuthService::respondNotLoggedIn();

      parent::__construct('capture');
      return;
    }

    if ($route === 'capture' && $action === 'create') {

      AuthService::respondNotLoggedIn();

      $file = $_FILES['file'];
      $picture = $_POST['picture'];
      $flowers = $_POST['flowers'];
      $unicorn = $_POST['unicorn'];
      $sun = $_POST['sun'];

      $data = [
        'picture' => $picture,
        'file' => $file,
        'flowers' => $flowers,
        'unicorn' => $unicorn,
        'sun' => $sun
      ];

      $response = PictureService::savePicture($data);

      HttpResponseService::sendJson($response, 201);
      return;
    }

    HttpResponseService::sendNotFound();
  }
}

?>