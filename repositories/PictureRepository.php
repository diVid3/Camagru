<?php

class PictureRepository implements IPictureRepository {

  public static function createPicture($accountId, $path) {

    $connection = Database::getConnection();

    $query = 'INSERT INTO Picture(accountId, path) VALUES (?, ?)';
    $statement = $connection->prepare($query);
    $statement->execute([$accountId, $path]);
    $lastInsertId = $connection->lastInsertId();

    return $lastInsertId;
  }

  public static function getPictures() {

    $connection = Database::getConnection();

    $query = 'SELECT * FROM Picture ORDER BY id DESC';
    $statement = $connection->prepare($query);
    $statement->execute([]);

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
  }

  public static function getPicturesByEmail($email) {

    $connection = Database::getConnection();

    $query = 'SELECT Picture.id, Picture.path FROM Account INNER JOIN Picture ON Picture.accountId = Account.id WHERE Account.email = ? ORDER BY Picture.id DESC';
    $statement = $connection->prepare($query);
    $statement->execute([$email]);

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
  }

  public static function getPictureById($id) {

    $connection = Database::getConnection();

    $query = 'SELECT * FROM Picture WHERE id = ?';

    $statement = $connection->prepare($query);
    $statement->execute([$id]);

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    return $row;
  }

  public static function deletePictureById($id) {

    $connection = Database::getConnection();

    $query1 = 'SELECT * FROM Picture WHERE id = ?';

    $statement = $connection->prepare($query1);
    $statement->execute([$id]);

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $path = ltrim($row['path'], '/');

    unlink($path);

    $query2 = 'DELETE FROM Picture WHERE id = ?';
    $statement = $connection->prepare($query2);
    $statement->execute([$id]);
  }
}

?>
