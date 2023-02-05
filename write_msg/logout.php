<?php
  include_once("../session.php");
  function logout() {
    $session = new BoardWriterSession();
    $session->destroy();
    header("Location: .");
  }
  logout();
?>