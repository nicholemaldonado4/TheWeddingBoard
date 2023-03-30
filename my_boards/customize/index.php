<?php 
  include_once("../../session.php");
  $session = new BoardMakerSession();
  $session->redirectIfNotLoggedIn("../../");
  $loggedIn = True;
  define('_HEADER_ACCESS', 1);

  $my_var = "blue";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Wedding Board | Customize</title>
  
  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lobster Two|Assistant">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="../../css/header.css">
  <link rel="stylesheet" href="../../css/my_boards/customize/index.css">
  <link rel="stylesheet" href="../../css/my_boards/customize/dynamic_index.php">
</head>
<body>
  <?php require_once '../../php/header.php';
    
  ?>
  <section class="customize-sect">
    <div class="board-settings-sect">
      <form class="board-settings" method="post" action="update_board.php">
        <label for="board_title">Board Title</label>
        <input type="text" name="board_title">
        <label for="board_password">Board Password</label>
        <input type="text" name="board_password">
        
        <label for="banner_title">Banner Title</label>
        <input type="text" name="banner_title">
        
        <label for="background_color">Background Color</label>
        <input type="color" name="background_color">
        <label for="foreground_color">Foreground Color</label>
        <input type="color" name="foreground_color">
  
        <input type="submit" value="Save Board">
      </form>
    </div>
    <div class="board-view">
      
    </div>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="../../js/header.js"></script>
  <script src="../../js/my_boards/customize/index.js"></script>
</body>