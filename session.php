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

# Session to write to board
class BoardWriterSession extends Session {
  function isLoggedIn() {
    return array_key_exists("writer_board_pin", $_SESSION) &&
        !empty($_SESSION['writer_board_pin']);
  }
  
  function markLogIn($id) {
    $_SESSION['writer_board_pin'] = $id;
  }
  
  function getBoardPin() {
    if ($this->isLoggedIn()) {
      return $_SESSION['writer_board_pin'];
    }
    return '';
  }
  
  function destroy() {
    if ($this->isLoggedIn()) {
      unset($_SESSION["writer_board_pin"]);
    }
  }
}

# Session to view someone's board.
class BoardViewerSession extends Session {
  function isLoggedIn() {
    return array_key_exists("viewer_board_pin", $_SESSION) &&
        !empty($_SESSION['viewer_board_pin']);
  }
  
  function markLogIn($id) {
    $_SESSION['viewer_board_pin'] = $id;
  }
  
  function getBoardPin() {
    if ($this->isLoggedIn()) {
      return $_SESSION['viewer_board_pin'];
    }
    return '';
  }
  
  function destroy() {
    if ($this->isLoggedIn()) {
      unset($_SESSION["viewer_board_pin"]);
    }
  }
}

# Session for logging in to see all your boards and edit/create
# new boards.
class BoardMakerSession extends Session {
  function isLoggedIn() {
    return array_key_exists("username", $_SESSION) &&
        !empty($_SESSION['username']);
  }
  
  function hasEditingBoardPin() {
    return array_key_exists("board_maker_edit_pin", $_SESSION) &&
      !empty($_SESSION['board_maker_edit_pin']);
  }
  
  function getUsername() {
    if ($this->isLoggedIn()) {
      return $_SESSION["username"];
    }
    return "";
  }
  
  function getEditingBoardPin() {
    if ($this->isLoggedIn()) {
      return $_SESSION["board_maker_edit_pin"];
    }
    return "";
  }
  
  function markEditingBoardPin($pin) {
    $_SESSION["board_maker_edit_pin"] = $pin;
  }
  
  function markLogIn($id) {
    $_SESSION['username'] = $id;
  }
  
  function destroy() {
    if (array_key_exists("username", $_SESSION)) {
      unset($_SESSION["username"]);
    }
    if (array_key_exists("board_maker_edit_pin", $_SESSION)) {
      unset($_SESSION["board_maker_edit_pin"]);
    }
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