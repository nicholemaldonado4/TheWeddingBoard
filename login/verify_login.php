<?php


include_once("../database.php");
include_once("../session.php");

function verify_login() {
  if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../");
    exit();
  }
  $username = array_key_exists("username", $_POST) ? $_POST["username"] : "";
  $password = array_key_exists("password", $_POST) ? $_POST["password"] : "";
  
  $session = new Session();
  $db = new Database();
  $err  = $db->connect();
  if (!empty($err)) {
    $session->setFlashData(new FlashData($err, ["username"=>$username, "password"=>$password]));
    header("Location: index.php");
    exit();
  }
  
  // Check if user exists.
  $stmt = $db->getCon()->prepare("SELECT * FROM WBUser WHERE UUsername=? AND UPassword=?");
  $stmt->bind_param('ss', $username, $password);
  if ($stmt->execute() == FALSE) {
    $session->setFlashData(new FlashData('An error occured. Please try again.', 
                                     ["username"=>$username, "password"=>$password]));
    header("Location: index.php");
    exit();
  }
  
  $resultUser = $stmt->get_result();
  if ($resultUser !== FALSE && $resultUser->num_rows > 0) {
    $session->markLogIn($username);
    header("Location: ../my_boards/index.php");
    exit();
  } 
  $session->setFlashData(new FlashData("The username and/or password was incorrect.".
                                   " Please try again.",
                                   ["username"=>$username, "password"=>$password]));
  header("Location: index.php");
  exit();
  print_r($_SESSION);
}

verify_login();
?>