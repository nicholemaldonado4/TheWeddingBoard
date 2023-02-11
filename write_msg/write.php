<?php 
  include_once("../session.php");
  $session = new BoardWriterSession();
  $session->redirectIfNotLoggedIn(".");
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wedding Board | Write Message</title>
  
  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lobster Two|Assistant">
  <link href="/css/write_msg/write.css" rel="stylesheet">
  <link href="/css/header.css" rel="stylesheet">
  
</head>
<body>
  <nav>
    <ul class="left-nav">
      <h1 class="logo-name">Wedding Board</h1>
    </ul>
    
    <img class="toggle" src="../imgs/menu_bars.svg" alt="Drop Down Menu Bars">
    <ul class="right-nav">
      <li><a href="logout.php">Log Out</a></li>
    </ul>
  </nav>
  <section class="msg-sect">
    <form>
      <div class="msg-div">
        <label for="board_msg">Write a Message</label>
        <textarea name="board_msg"></textarea>
        <p class="light-font">Char Left: <span id='char-left'>200</span></p>
      </div>
      <div>
        <label for="board_img">Add an Image</label>
        <input type="file" accept="image/png, image/jped" name="board_img">
      </div>
      <input type="submit" value="Write to Board">
    </form>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="/js/header.js"></script>
  <script src="/js/write_msg/write.js"></script>
</body>