<?php
  include_once("../session.php");
  function logout() {
    $session = new BoardMakerSession();
    $session->destroy();
    header("Location: /");
  }
  logout();
?>