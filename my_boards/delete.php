
<?php

include_once("../database.php");
include_once("../session.php");
$session = new BoardMakerSession();
$session->redirectIfNotLoggedIn("../");

function delete_board($session) {
  if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    header("Location: ../");
    exit();
  }
  
  $_GET_lower = array_change_key_case($_GET, CASE_LOWER);
  
  # If user does not provide board name, ignore request.
  if (!array_key_exists("board", $_GET)) {
    header("Location: index.php");
    exit();
  }
  
  $username = $session->getUsername();
  $board = $_GET["board"];
  
  $db = new Database();
  $err  = $db->connect();
  if (!empty($err)) {
    $session->setFlashData(new FlashData("A problem occurred. Please try again."));
    header("Location: index.php");
    exit();
  }
  
  // Delete table
  $stmt = $db->getCon()->prepare("DELETE FROM WEDDING_BOARD WHERE WUsername=? AND WTitle=?");
  $stmt->bind_param('ss', $username, $board);
  if ($stmt->execute() == FALSE) {
    $session->setFlashData(new FlashData("Unable to delete board $board."));
    echo "Unable to execute";
  }
  header("Location: index.php");
  exit();
}

delete_board($session);

?>