<?php
  include_once("../session.php");
  function logout() {
    $session = new Session();
    $session->destroy();
    header("Location: /");
  }
  logout();
?>