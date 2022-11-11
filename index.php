<?php 
  include_once("session.php");
  $session = new Session();
  $loggedIn = $session->isLoggedIn();
  define('_HEADER_ACCESS', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Wedding Board</title>
  
  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lobster Two|Assistant">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <?php require_once 'php/header.php';?>
</body>