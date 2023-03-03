<?php 
  include_once("../session.php");
  include_once("write_form_data.php");
  define('_HEADER_ACCESS', 1);
  $session = new BoardWriterSession();
  $session->redirectIfNotLoggedIn(".");
  $formData = new WriteFormData($session->hasFlashData() ? $session->GetFlashData() : NULL);
  $session->clearFlashData();
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
  <?php require_once '../php/logout_header.php';?>
  <section class="msg-sect">
    <?php
    if ($formData->hasError()) {
      $type = $formData->wasUploaded() ? "success" : "error";
      $initial = $formData->wasUploaded() ? "" : "* ";
      echo "<p class='$type'>".$initial.$formData->getError()."</p>";
    }     
    ?>
    <form method="post" action="add_to_board.php" enctype="multipart/form-data">
      <div class="msg-div">
        <h2 for="board_msg">Write a Message</h2>
        <textarea name="board_msg"><?=$formData->getBoardMsg()?></textarea>
        <p class="light-font">Char Left: <span id='char-left'>200</span></p>
      </div>
      <div>
        <h2>Add an Image</h2>
        <div class="previewer">
          <img class="img-preview hidden">
          <i class="fa-regular fa-image"></i>
          <label for="board_img" class="input-btn">Upload Image</label>
        </div>
        <input type="file" accept="image/png, image/jpeg" name="file_img" id="board_img">
      </div>
      <input type="submit" value="Write to Board">
    </form>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="/js/header.js"></script>
  <script src="/js/write_msg/write.js"></script>
</body>