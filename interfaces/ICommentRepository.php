<?php

interface ICommentRepository {

  public static function createComment($accountId, $pictureId, $text);
  public static function getCommentsByPictureId($id);
}

?>
