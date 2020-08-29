<?php

class LikerRepository implements ILikerRepository {

  public static function editLiker($accountId, $pictureId) {

    $connection = Database::getConnection();

    $query1 = 'SELECT * FROM Liker WHERE accountId = ? AND pictureId = ?';

    $statement = $connection->prepare($query1);
    $statement->execute([$accountId, $pictureId]);

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) === 0) {

      $query2 = 'INSERT INTO Liker(accountId, pictureId) VALUES (?, ?)';

      $statement = $connection->prepare($query2);
      $statement->execute([$accountId, $pictureId]);

      return [
        'success' => true,
        'data' => [
          'likeState' => 'liked'
        ]
      ];
    }

    $query3 = 'DELETE FROM Liker WHERE accountId = ? AND pictureId = ?';

    $statement = $connection->prepare($query3);
    $statement->execute([$accountId, $pictureId]);

    return [
      'success' => true,
      'data' => [
        'likeState' => 'unliked'
      ]
    ];
  }

  public static function getLikerCountByPictureId($pictureId) {

    $connection = Database::getConnection();

    $query = 'SELECT COUNT(*) AS likerCount FROM Liker WHERE pictureId = ?';

    $statement = $connection->prepare($query);
    $statement->execute([$pictureId]);

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    return $row;
  }

  public static function getDidLikeByPictureId($accountId, $pictureId) {

    $connection = Database::getConnection();

    $query = 'SELECT * FROM Liker WHERE accountId = ? AND pictureId = ?';

    $statement = $connection->prepare($query);
    $statement->execute([$accountId, $pictureId]);

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) === 0) {

      return [
        'didLike' => false
      ];
    }

    return [
      'didLike' => true
    ];
  }
}

?>
