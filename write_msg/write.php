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
<!--  <link href="/css/login/index.css" rel="stylesheet">-->
  
</head>
<body>
  <nav>
    <h1>Wedding Board</h1>
    <form method="get" action="logout.php">
      <button type="submit">Log Out</button>
    </form>
  </nav>
  <section>
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