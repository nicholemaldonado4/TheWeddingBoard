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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
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
        <h2 for="board_msg">Write a Message</h2>
        <textarea name="board_msg"></textarea>
        <p class="light-font">Char Left: <span id='char-left'>200</span></p>
      </div>
      <div>
        <h2>Add an Image</h2>
        <div class="previewer">
          <img class="img-preview hidden">
          <i class="fa-regular fa-image"></i>
          <label for="board_img" class="input-btn">Upload Image</label>
        </div>
        <input type="file" accept="image/png, image/jpeg" name="file-img" id="board_img">
      </div>
      <input type="submit" value="Write to Board">
    </form>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="/js/header.js"></script>
  <script src="/js/write_msg/write.js"></script>
</body>