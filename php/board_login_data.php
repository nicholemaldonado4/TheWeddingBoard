<?php
  include_once("../form_data.php");
  class BoardLoginData extends FormData {    
    function __construct($flashData = NULL) {
      parent::__construct($flashData);
    }
    
    function getBoardPin() {
      return $this->getKey("board_pin", "");
    }
    
    function getBoardPassword() {
      return $this->getKey("board_password", "");
    }
  }

?>