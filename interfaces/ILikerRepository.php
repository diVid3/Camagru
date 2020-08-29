<?php

interface ILikerRepository {

  public static function editLiker($accountId, $pictureId);
  public static function getLikerCountByPictureId($pictureId);
  public static function getDidLikeByPictureId($accountId, $pictureId);
}

?>
