<?php

class PictureService implements IPictureService {

  private static function mergeSticker($picturePath, $stickerPath, $position) {

    $storedPicture = imagecreatefrompng($picturePath);
    $storedSticker = imagecreatefrompng($stickerPath);

    $storedPictureWidth = imagesx($storedPicture);
    $storedPictureHeight = imagesy($storedPicture);
    $storedStickerWidth = imagesx($storedSticker);
    $storedStickerHeight = imagesy($storedSticker);

    $dstXOffset = 20;
    $dstYOffset = 20;

    if ($position === 'top-right') {

      $dstXOffset = $storedPictureWidth - $storedStickerWidth - 20;
      $dstYOffset = 20;
    }

    if ($position === 'bottom-left') {

      $dstXOffset = 20;
      $dstYOffset = $storedPictureHeight - $storedStickerHeight - 20;
    }

    if ($position === 'bottom-right') {

      $dstXOffset = $storedPictureWidth - $storedStickerWidth - 20;
      $dstYOffset = $storedPictureHeight - $storedStickerHeight - 20;
    }

    imagecolortransparent($storedSticker, imagecolorat($storedSticker, 0, 0));

    // The stickers will always have the same dimensions.
    imagecopymerge(
      $storedPicture,
      $storedSticker,
      $dstXOffset,
      $dstYOffset,
      0,
      0,
      imagesx($storedSticker),
      imagesy($storedSticker),
      100
    );

    unlink($picturePath);

    $guid = uniqid();
    $picturePath = 'pictures'.'/'.$guid.'.png';

    imagepng($storedPicture, $picturePath);

    return $picturePath;
  }

  private static function mergeStickers($dest, $data) {

    if ($data['sun'] === 'true') {
      $dest = self::mergeSticker($dest, 'assets/stickers/sun128.png', 'top-right');
    }

    if ($data['flowers'] === 'true') {
      $dest = self::mergeSticker($dest, 'assets/stickers/flowers128.png', 'bottom-left');
    }

    if ($data['unicorn'] === 'true') {
      $dest = self::mergeSticker($dest, 'assets/stickers/unicorn128.png', 'bottom-right');
    }

    return $dest;
  }

  private static function saveUploadedPicture($data) {

    $response = [
      'success' => true,
      'message' => 'image created'
    ];

    try {

      $guid = uniqid();
      $extension = explode('/', $data['file']['type'])[1];
      $dest = 'pictures'.'/'.$guid.'.'.$extension;
      $didMove = move_uploaded_file($data['file']['tmp_name'], $dest);

      if (!$didMove) {
        throw new Exception('Couldn\'t move file');
      }

      // Convert file to png if jpg or jpeg.
      if ($extension === 'jpg' || $extension === 'jpeg') {

        $guid = uniqid();
        $newDest = 'pictures'.'/'.$guid.'.png';
        imagepng(imagecreatefromstring(file_get_contents($dest)), $newDest);
        unlink($dest);
        $dest = $newDest;
      }

      $finalDest = self::mergeStickers($dest, $data);

      // TODO: Persist to db here. Use repo.
      // TODO: Remember to add path + id to response.

    } catch (Exception $e) {

      error_log($e);

      $response = [
        'success' => false,
        'message' => 'Couldn\'t save uploaded file'
      ];
    }

    return $response;
  }

  private static function saveCapturedPicture($data) {

    $response = [
      'success' => true,
      'message' => 'image created'
    ];

    try {

      $picture = $data['picture'];
      $picture = str_replace('data:image/png;base64,', '', $picture);
      $picture = str_replace(' ', '+', $picture);

      $guid = uniqid();
      $dest = 'pictures'.'/'.$guid.'.png';

      file_put_contents($dest, base64_decode($picture));

      $finalDest = self::mergeStickers($dest, $data);

      // TODO: Persist to db here. Use repo.
      // TODO: Remember to add path + id to response.

    } catch(Exception $e) {

      error_log($e);

      $response = [
        'success' => false,
        'message' => 'Couldn\'t save captured image'
      ];
    }

    return $response;
  }

  public static function savePicture($data) {

    $response = [
      'success' => true,
      'message' => 'image created'
    ];

    if (isset($data['file'])) {
      return $response = self::saveUploadedPicture($data);
    }

    if (isset($data['picture'])) {
      return $response = self::saveCapturedPicture($data);
    }

    return $response;
  }
}

?>