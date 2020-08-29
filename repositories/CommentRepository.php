<?php

class CommentRepository implements ICommentRepository {

  public static function createComment($accountId, $pictureId, $text) {

    $connection = Database::getConnection();

    $query = 'INSERT INTO Comment(accountId, pictureId, text) VALUES (?, ?, ?)';

    $statement = $connection->prepare($query);
    $statement->execute([$accountId, $pictureId, $text]);
  }

  public static function getCommentsByPictureId($id) {

    $connection = Database::getConnection();

    $query = 'SELECT Account.username, Comment.text FROM Comment INNER JOIN Account ON Comment.accountId = Account.id WHERE Comment.pictureId = ? ORDER BY Comment.id DESC';

    $statement = $connection->prepare($query);
    $statement->execute([$id]);

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
  }
}

?>
