<?php
  include_once("../form_data.php");
  class LoginData extends FormData {    
    function __construct($flashData = NULL) {
      parent::__construct($flashData);
    }
    
    function getUsername() {
      return $this->getKey("username", "");
    }
    
    function getPassword() {
      return $this->getKey("password", "");
    }
  }

?>