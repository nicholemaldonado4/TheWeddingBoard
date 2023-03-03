<?php 
  include_once("../session.php");
  include_once("../php/board_login.php");
  $session = new BoardViewerSession();
  $session->redirectIfLoggedIn("viewer.php");
  $boardLoginData = new BoardLoginData($session->hasFlashData() ? $session->GetFlashData() : NULL);
  $session->clearFlashData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Wedding Board | Boards</title>
  
  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lobster Two|Assistant">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="../css/boards/index.css">
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
        <input type="password" name="board_password" value="<?=$boardLoginData->getBoardPassword()?>">
      </div>
      <?php 
        if ($boardLoginData->hasError()) {
          echo "<p class='err_msg'>".$boardLoginData->getError()."</p>";
        }
      ?>
      <input type="submit" value="View Board">
    </form>
  </div>
  <section class="info-sect">
    <p>Create your own board for FREE at <a href="../" class="link">Wedding Board</a></p>
  </section>
</body>


    
 