<?php 
  include_once("../session.php");
  include_once("login_data.php");
  $session = new BoardMakerSession();
  $session->redirectIfLoggedIn("/");
  $loginData = new LoginData($session->hasFlashData() ? $session->GetFlashData() : NULL);
  $session->clearFlashData();
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wedding Board | Log In</title>
  
  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lobster Two|Assistant">
  <link href="/css/login/index.css" rel="stylesheet">
</head>
<body>
  <div class="title-banner"><h1><a href="/">Wedding Board</a></h1></div>
  <div class="form-box">
    <h2>Login</h2>
    <form action="verify_login.php" method="post">
      <div>
      <label for="username">Username</label>
      <input type="text" name="username" value="<?=$loginData->getUsername()?>">
      </div>
      <div>
      <label for="password">Password</label>
      <input type="password" name="password" value="<?=$loginData->getPassword()?>">
      </div>
      <?php 
        if ($loginData->hasError()) {
          echo "<p>".$loginData->getError()."<p>";
        }
      ?>
      <input type="submit" value="Log In">
    </form>
    <p>Need an account?&nbsp&nbsp<a href="/signup" class="link">Sign Up</a></p>
  </div>
</body>