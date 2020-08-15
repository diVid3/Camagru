<?php

class FeatureController extends Controller {

  function __construct($route, $action, $id) {

    if ($route === 'gallery' && $action === 'show') {
      parent::__construct('gallery');
      return;
    }

    if ($route === 'capture' && $action === 'show') {
      parent::__construct('capture');
      return;
    }

    if ($route === 'picture' && $action === 'show' && $id !== '') {

      // TODO: Fetch he picture by id and it's comments.

      parent::__construct('picture');
      return;
    }
  }
}

?>