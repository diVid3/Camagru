<?php

class Controller {

  function __construct($viewName) {

    require_once('./views/'.$viewName.'.php');
    return die();
  }
}

?>