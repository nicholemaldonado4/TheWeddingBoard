<?php

include_once("../database.php");

# Assumes the session is logged in.
function get_boards($session) {
  $db = new Database();
  $err  = $db->connect();
  if (!empty($err)) {
    $session->setFlashData(new FlashData($err));
    header("Location: index.php");
    exit();
  }
  
  $stmt = $db->getCon()->prepare("SELECT WTitle, WPin, WPassword FROM WEDDING_BOARD WHERE WUsername=?");
  $username = $session->getUsername();
  $stmt->bind_param('s', $username);
  if ($stmt->execute() == FALSE) {
    $session->setFlashData(new FlashData('Unable to collect user boards. Please refresh the page.'));
    header("Location: index.php");
    exit();
  }
  $stmt->bind_result($title, $pin, $password);
  $spacing = "&nbsp&nbsp&nbsp";
  while ($stmt->fetch()) {
    echo "<tr>";
    echo "<td scope='row' data-label='Board'>$title</td>";
    echo "<td scope='row' data-label='Pin'>$pin</td>";
    echo "<td scope='row' data-label='Password'>$password</td>";
    echo "<td scope='row' data-label='Actions'><div><a href=customize?op=edit&board=$title>Edit</a>".
      " $spacing <a href=delete.php?board=$title>Delete</a></div></td>";
    echo "</tr>";
  }        
}

?>