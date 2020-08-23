<?php

interface IHttpResponseService {

  public static function sendNotFound();
  public static function sendUnauthorized();
  public static function sendServerError();
  public static function sendEcho($message);
  public static function redirect($fullUrl);
  public static function sendJson($data, $responseCode);
}

?>