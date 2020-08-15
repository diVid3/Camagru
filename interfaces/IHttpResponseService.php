<?php

interface IHttpResponseService {

  public static function sendNotFound();
  public static function redirect($fullUrl);
  public static function sendJson($data, $responseCode);
}

?>