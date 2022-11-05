<?php
  class FormData {
    private $flashData;
    
    function __construct($flashData = NULL) {
      $this->flashData = $flashData;
    }
    
    function getKey($key, $defaultVal) {
      if ($this->flashData == NULL) {
        return $defaultVal;
      }
      $data = $this->flashData->getData();
      if ($data === NULL) {
        return $defaultVal;
      }
            
      return array_key_exists($key, $data) ? $data[$key] : $defaultVal;
    }

    function hasError() {
      return $this->flashData != NULL;
    }
    
    function getError() {
      return $this->flashData->getMsg();
    }
  }


?>