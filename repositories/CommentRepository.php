<?php

class CommentRepository implements ICommentRepository {

  public static function createComment($accountId, $pictureId, $text) {

    // Will get the accountId from the session, pictureId and the text from the FE.

    $connection = Database::getConnection();

    $query = 'INSERT INTO Comment(accountId, pictureId, text) VALUES (?, ?, ?)';

    $statement = $connection->prepare($query);
    $statement->execute([$accountId, $pictureId, $text]);
  }

  public static function getCommentsByPictureId($id) {


  }
}

?>
