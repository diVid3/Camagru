<?php

interface IPictureRepository {

  public static function createPicture($accountId, $path);
  public static function getPictures();
  public static function getPicturesByEmail($email);
  public static function getPictureById($id);
  public static function deletePictureById($id);
}

?>
