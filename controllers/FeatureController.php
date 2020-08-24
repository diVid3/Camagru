<?php

class FeatureController extends Controller {

  function __construct($route, $action, $id) {

    if ($route === 'gallery' && $action === 'show') {

      try {

        $rows = PictureRepository::getPictures();

      } catch (PDOException $e) {

        error_log($e);
        HttpResponseService::sendServerError();
      }

      $_SESSION['viewBag'] = [
        'rows' => $rows
      ];

      parent::__construct('gallery');
      return;
    }

    if ($route === 'picture' && $action === 'show' && $id !== '') {

      AuthService::respondNotLoggedIn();

      // TODO: Fetch the picture by id and it's comments and likes.

      parent::__construct('picture');
      return;
    }

    if ($route === 'picture' && $action === 'delete' && $id !== '') {

      AuthService::respondNotLoggedIn();

      try {

        $rows = PictureRepository::deletePictureById($id);

      } catch (PDOException $e) {

        error_log($e);
        HttpResponseService::sendServerError();
      }

      $response = [
        'success' => true,
        'message' => 'Picture deleted'
      ];

      HttpResponseService::sendJson($response, 200);
      return;
    }

    if ($route === 'capture' && $action === 'show') {

      try {

        $email = $_SESSION['email'];
        $rows = PictureRepository::getPicturesByEmail($email);

      } catch (PDOException $e) {

        error_log($e);
        HttpResponseService::sendServerError();
      }

      $_SESSION['viewBag'] = [
        'rows' => $rows
      ];

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

    // POST
    if ($route === 'comment' && $action === 'create') {

      try {

        $email = $_SESSION['email'];
        $rows = PictureRepository::getPicturesByEmail($email);

      } catch (PDOException $e) {

        error_log($e);
        HttpResponseService::sendServerError();
      }

      $_SESSION['viewBag'] = [
        'rows' => $rows
      ];
    }

    HttpResponseService::sendNotFound();
  }
}

?>