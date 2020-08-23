<?php

interface ICommentRepository {

  public static function createComment();
  public static function getCommentsByPictureId($id);
}

?>
