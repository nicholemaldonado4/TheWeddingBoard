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
  
</head>
<body>
  <nav>
    <h1>Wedding Board</h1>
    <div class='nav_link'>
      <a href="logout.php" >Log Out</a>
    </div>
  </nav>
  <section class="msg-sect">
    <form>
      <div>
        <label for="board_msg">Write a Message</label>
        <textarea name="board_msg"></textarea>
      </div>
      <div>
        <label for="board_img">Add an Image</label>
        <input type="file" accept="image/png, image/jped" name="board_img">
      </div>
      <input type="submit" value="Write to Board">
    </form>
  </section>
</body>