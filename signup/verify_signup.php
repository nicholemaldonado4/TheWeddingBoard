<?php


include_once("../database.php");
include_once("../session.php");

function hasWhitespace($text) {
  $text = str_split($text);
  foreach ($text as $letter) {
    if (ctype_space($letter)) {
      return TRUE;
    }
  }
  return FALSE;
}

function getSignUpFlashData($msg, $firstName, $lastName, $username, $password) {
  return new FlashData($msg, ["first_name"=>$firstName,
                             "last_name"=>$lastName,
                             "username"=>$username,
                             "password"=>$password]);
}

function validFirstName($firstName) {
  if (!preg_match('/^[A-Za-z]{1,60}$/', $firstName)) {
    return "Invalid first name. A first name must have between 1 to 60 letters only.";
  }
  return TRUE;
}

function validUsername($username) {
  if (!preg_match('/^[A-Za-z][A-Za-z0-9]{2,31}$/', $username)) {
    return "Invalid username. A username must start with a letter, ".
      "have between 3 to 32 characters, and contain only letters and numbers";
  }
  return TRUE;
}

function validPassword($password) {
  if (hasWhitespace($password)) {
    return "Invalid password. A password cannot contain whitespace.";
  }
  $password_len = strlen($password);
  if ($password_len  < 8 or $password_len > 60) {
    return "Invalid password. A password must have between 8 to 60 characters.";
  }
  return TRUE;
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
  
  if (!array_key_exists("first_name", $_POST) || 
      empty($_POST["first_name"]) ||
      !array_key_exists("username", $_POST) ||
      empty($_POST["username"]) ||
      !array_key_exists("password", $_POST) ||
      empty($_POST["password"])) {
    $session->setFlashData(getSignUpFlashData("The first name, username, and password are required",
                                              $firstName, $lastName, $username, $password));
    header("Location: index.php");
    exit();
  }
  
  if (($msg = validFirstName($firstName)) !== TRUE ||
      ($msg = validUsername($username)) !== TRUE ||
      ($msg = validPassword($password)) !== TRUE) {
    $session->setFlashData(getSignUpFlashData($msg, $firstName, $lastName,
                                              $username, $password));
    header("Location: index.php");
    exit();
  }
  
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