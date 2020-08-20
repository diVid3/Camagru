<?php

class PictureService implements IPictureService {

  private static function mergeSticker($dest, $stickerPath, $coordinates) {

    $storedPicture = imagecreatefrompng($dest);
    $storedSticker = imagecreatefrompng($stickerPath);

    imagecolortransparent($storedSticker, imagecolorat($storedSticker, 0, 0));

    // The stickers will always have the same dimensions.
    imagecopymerge(
      $storedPicture,
      $storedSticker,
      $coordinates['dst_x'],
      $coordinates['dst_y'],
      $coordinates['src_x'],
      $coordinates['src_y'],
      imagesx($storedSticker),
      imagesy($storedSticker),
      100
    );

    unlink($dest);

    $guid = uniqid();
    $dest = 'pictures'.'/'.$guid.'.png';

    imagepng($storedPicture, $dest);

    return $dest;
  }

  private static function mergeStickers($dest, $data) {

    if ($data['sun'] === 'true') {

      $dest = self::mergeSticker($dest, 'assets/stickers/sun128.png', [
        'dst_x' => 492,
        'dst_y' => 20,
        'src_x' => 0,
        'src_y' => 0
      ]);
    }

    if ($data['flowers'] === 'true') {

      $dest = self::mergeSticker($dest, 'assets/stickers/flowers128.png', [
        'dst_x' => 20,
        'dst_y' => 332,
        'src_x' => 0,
        'src_y' => 0
      ]);
    }

    if ($data['unicorn'] === 'true') {

      $dest = self::mergeSticker($dest, 'assets/stickers/unicorn128.png', [
        'dst_x' => 492,
        'dst_y' => 332,
        'src_x' => 0,
        'src_y' => 0
      ]);
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

      $finalDest = self::mergeStickers($dest, $data);

      // TODO: Persist to db here. Use repo.
      // TODO: Remember to add path + id to response.

    } catch (Exception $e) {

      $response = [
        'success' => false,
        'message' => $e
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

      $response = [
        'success' => false,
        'message' => $e
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