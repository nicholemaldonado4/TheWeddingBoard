<?php
  include_once("../form_data.php");
  class WriteFormData extends FormData {    
    function __construct($flashData = NULL) {
      parent::__construct($flashData);
    }
    
    function getBoardMsg() {
      return $this->getKey("board_msg", "");
    }
    
    
    function wasUploaded() {
      return $this->getKey("was_uploaded", FALSE);
    }
  }

?>