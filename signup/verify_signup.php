<?php


include_once("../database.php");
include_once("../session.php");

function getSignUpFlashData($msg, $firstName, $lastName, $username, $password) {
  return new FlashData($msg, ["first_name"=>$firstName,
                             "last_name"=>$lastName,
                             "username"=>$username,
                             "password"=>$password]);
}

function verifySignUp() {
  if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../");
    exit();
  }
  $firstName = array_key_exists("first_name", $_POST) ? $_POST["first_name"] : "";
  $lastName = array_key_exists("last_name", $_POST) ? $_POST["last_name"] : "";
  $username = array_key_exists("username", $_POST) ? $_POST["username"] : "";
  $password = array_key_exists("password", $_POST) ? $_POST["password"] : "";
  
  $session = new Session();
  $db = new Database();
  $err  = $db->connect();
  if (!empty($err)) {
    $session->setFlashData(getSignUpFlashData($err, $firstName, $lastName,
                                              $username, $password));
    header("Location: index.php");
    exit();
  }
  
  $stmt  = $db->getCon()->prepare("INSERT INTO WBUSER (UUsername, UPassword, UFirstName,".
                " ULastName) VALUES (?,?,?,?);");
  $stmt->bind_param('ssss', $username, $password, $firstName, $lastName);
  if ($stmt->execute() === FALSE) {
    
    $msg = $stmt->errno == 1062 ? "The username already exists." : "An error occurred. Please try again.";
    $session->setFlashData(getSignUpFlashData($msg, $firstName, $lastName,
                                            $username, $password));
    header("Location: index.php");
    exit();
  }
  $session->markLogIn($username);
  header("Location: ../my_boards/index.php");
  exit();
}

verifySignUp();
?>