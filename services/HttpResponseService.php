<?php

class HttpResponseService implements IHttpResponseService {

  public static function sendNotFound() {

    http_response_code(404);
    die();
  }

  public static function sendUnauthorized() {

    http_response_code(401);
    die();
  }

  public static function sendServerError() {

    http_response_code(500);
    die();
  }

  public static function sendEcho($message) {

    http_response_code(200);
    echo $message;
    die();
  }

  public static function redirect($fullUrl) {

    header('Location: '.$fullUrl);
    die();
  }

  public static function sendJson($data, $responseCode) {

    http_response_code($responseCode);
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($data);
    die();
  }
}

?>