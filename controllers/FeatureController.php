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

      if (!AuthService::isLoggedIn()) {
        HttpResponseService::redirect('http://localhost:8080/login/show');
      }

      $accountId = $_SESSION['id'];

      try {

        $commentRows = CommentRepository::getCommentsByPictureId($id);
        $pictureRow = PictureRepository::getPictureById($id);
        $likerCountRow = LikerRepository::getLikerCountByPictureId($id);
        $didLikeArr = LikerRepository::getDidLikeByPictureId($accountId, $id);

      } catch (PDOException $e) {

        error_log($e);
        HttpResponseService::sendServerError();
      }

      $_SESSION['viewBag'] = [
        'pictureRow' => $pictureRow,
        'commentRows' => $commentRows,
        'likerCountRow' => $likerCountRow,
        'didLikeArr' => $didLikeArr
      ];

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

      AuthService::respondNotLoggedIn();

      $accountId = $_SESSION['id'];
      $pictureId = $_POST['pictureId'];
      $text = $_POST['text'];

      try {

        CommentRepository::createComment($accountId, $pictureId, $text);

      } catch (PDOException $e) {

        error_log($e);
        HttpResponseService::sendServerError();
      }

      $username = $_SESSION['username'];

      $response = [
        'success' => true,
        'message' => 'Comment created',
        'data' => [
          'username' => $username
        ]
      ];

      HttpResponseService::sendJson($response, 201);
      return;
    }

    // GET
    if ($route === 'like' && $action === 'edit' && $id !== '') {

      AuthService::respondNotLoggedIn();

      $accountId = $_SESSION['id'];
      $pictureId = $id;

      try {

        $response = LikerRepository::editLiker($accountId, $pictureId);

      } catch (PDOException $e) {

        error_log($e);
        HttpResponseService::sendServerError();
      }

      HttpResponseService::sendJson($response, 201);
      return;
    }

    HttpResponseService::sendNotFound();
  }
}

?>