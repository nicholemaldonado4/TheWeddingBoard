
<?php

include_once("../database.php");
include_once("../session.php");

function delete_board() {
  if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../");
    exit();
  }
  
  # If user does not provide board name, ignore request.
  if (!array_key_exists("pin", $_POST)) {
    header("Location: index.php");
    exit();
  }
  $session = new BoardMakerSession();

  $pin = $_POST["pin"];
  
  $db = new Database();
  $err  = $db->connect();
  if (!empty($err)) {
    $session->setFlashData(new FlashData("A problem occurred. Please try again."));
    header("Location: index.php");
    exit();
  }
  
  // Delete board
  $stmt = $db->getCon()->prepare("DELETE FROM WEDDING_BOARD WHERE WPin=?");
  $stmt->bind_param('s', $pin);
  if ($stmt->execute() == FALSE) {
    $session->setFlashData(new FlashData("Unable to delete board with pin."));
  }
  header("Location: index.php");
  exit();
}

delete_board();

?>