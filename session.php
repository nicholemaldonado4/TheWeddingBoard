<?php

abstract class Session {
  function __construct() {
    session_start();
  }
  
  abstract function isLoggedIn();
  abstract function markLogIn($id);
  
  function redirectIfLoggedIn($redirectPath) {
    if ($this->isLoggedIn()) {
      header("Location: ".$redirectPath);
      exit();
    }
  }
  
  function redirectIfNotLoggedIn($redirectPath) {
    if (!$this->isLoggedIn()) {
      header("Location: ".$redirectPath);
      exit();
    }
  }
  
  function setFlashData($flashData) {
    $_SESSION['flash_data'] = $flashData->toMap();
  }
  
  function hasFlashData() {
    return array_key_exists("flash_data", $_SESSION);
  }
  
  function getFlashData() {
    return FlashData::fromMap($_SESSION["flash_data"]);
    
  }
  
  function clearFlashData() {
    if ($this->hasFlashData()) {
      unset($_SESSION["flash_data"]);
    }
  }
  
  function destroy() {
    session_destroy();
  }
}

class BoardWriterSession extends Session {
  function isLoggedIn() {
    return array_key_exists("board_pin", $_SESSION) &&
        !empty($_SESSION['board_pin']);
  }
  
  function markLogIn($id) {
    $_SESSION['board_pin'] = $id;
  }
}

class BoardMakerSession extends Session {
  function isLoggedIn() {
    return array_key_exists("username", $_SESSION) &&
        !empty($_SESSION['username']);
  }
  
  function getUsername() {
    if ($this->isLoggedIn()) {
      return $_SESSION["username"];
    }
    return "";
  }
  
  function markLogIn($id) {
    $_SESSION['username'] = $id;
  }
}

class FlashData {
  private $msg;
  private $data;
  
  function __construct($msg, $data=[]) {
    $this->msg = $msg;
    $this->data = $data;
  }
  
  static function fromMap($map) {
    return new FlashData(array_key_exists("msg", $map) ? $map["msg"] : "",
                        array_key_exists("data", $map) ? $map["data"] : []);
  }
  
  function toMap() {
    return ["msg" => $this->msg, "data" => $this->data];
  }
  
  function getMsg() {
    return $this->msg;
  }
  
  function getData() {
    return $this->data;
  }
}
?>