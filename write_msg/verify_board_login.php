<?php


include_once("../database.php");
include_once("../session.php");

function verify_login() {
  if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../");
    exit();
  }
  $boardPin = array_key_exists("board_pin", $_POST) ? $_POST["board_pin"] : "";
  $boardPassword = array_key_exists("board_password", $_POST) ? $_POST["board_password"] : "";
  
  $session = new BoardWriterSession();
  $db = new Database();
  $err  = $db->connect();
  if (!empty($err)) {
    $session->setFlashData(new FlashData($err, ["board_pin"=>$boardPin, "board_password"=>$boardPassword]));
    header("Location: index.php");
    exit();
  }
  
  // Check if user exists.
  $stmt = $db->getCon()->prepare("SELECT * FROM WEDDING_BOARD WHERE WPin=? AND WPassword=?");
  $stmt->bind_param('ss', $boardPin, $boardPassword);
  if ($stmt->execute() == FALSE) {
    $session->setFlashData(new FlashData('An error occured. Please try again.', 
                                     ["board_pin"=>$boardPin, "board_password"=>$boardPassword]));
    header("Location: index.php");
    exit();
  }
  
  $result = $stmt->get_result();
  if ($result !== FALSE && $result->num_rows > 0) {
    $session->markLogIn($boardPin);
    header("Location: write.php");
    exit();
  } 
  $session->setFlashData(new FlashData("The board pin and/or password was incorrect.".
                                   " Please try again.",
                                   ["board_pin"=>$boardPin, "board_password"=>$boardPassword]));
  header("Location: index.php");
  exit();
}

verify_login();
?>