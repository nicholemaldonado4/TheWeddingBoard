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
  while ($stmt->fetch()) {
    echo "<tr>";
    echo "<td>$title</td><td>$pin</td><td>$password</td>";
    echo "</tr>";
  }        
}

?>