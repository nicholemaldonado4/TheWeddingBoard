<?php
  include_once("../session.php");
  function logout() {
    $session = new BoardViewerSession();
    $session->destroy();
    header("Location: .");
  }
  logout();
?>