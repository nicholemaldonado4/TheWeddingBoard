<?php
  include_once("../login/login_data.php");
  class SignUpData extends LoginData {
    function __construct($flashData = NULL) {
      parent::__construct($flashData);
    }
    
    function getFirstName() {
      return $this->getKey("first_name", "");
    }
    
    function getLastName() {
      return $this->getKey("last_name", "");
    }
  }

?>