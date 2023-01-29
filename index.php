<?php 
  include_once("session.php");
  $session = new BoardMakerSession();
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
  
  <div class="banner">
    <p>The <em class='blue-em'>Guest Book </em><br class='hide'>Just Got Virtual</p>
    <img class="collage" src="/imgs/banner_collage.png" alt="Collage of married couples">
  </div>
  <div class='about'>
    <div></div>
    <div>
      <h2 class='sect-header'>Create your virtual guest book today!</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
  </div>
  <div class="steps">
    <h2 class="sect-header">How It Works</h2>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="js/header.js"></script>
</body>