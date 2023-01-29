<?php 
  include_once("../session.php");
  include_once("../php/board_login_data.php");
  $session = new BoardWriterSession();
//  $session->redirectIfLoggedIn("write.php");
  $boardLoginData = new BoardLoginData($session->hasFlashData() ? $session->GetFlashData() : NULL);
  $session->clearFlashData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Wedding Board | Write Message</title>
  
  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lobster Two|Assistant">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="../css/write_msg/index.css">
  <link rel="stylesheet" href="../css/login/form.css">
</head>
<body>
  <section class="title-banner">
    <h1>Wedding Board</h1>
  </section>
  <div class="form-box">
    <form action="verify_board_login.php" method="post">
      <div>
        <label for="board_pin">Board Pin</label>
        <input type="text" name="board_pin" value="<?=$boardLoginData->getBoardPin()?>">
      </div>
      <div>
        <label for="board_password">Board Password</label>
        <input type="text" name="board_password" value="<?=$boardLoginData->getBoardPassword()?>">
      </div>
      <?php 
        if ($boardLoginData->hasError()) {
          echo "<p>".$boardLoginData->getError()."</p>";
        }
      ?>
      <input type="submit" value="Write a Message">
    </form>
  </div>
  <section class="info-sect">
    <p>Create your own board for FREE at <a href="../" class="link">Wedding Board</a></p>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="../js/header.js"></script>
</body>


    
 