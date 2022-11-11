<?php 
  include_once("../session.php");
  include_once("signup_data.php");
  $session = new Session();
  $session->redirectIfLoggedIn("/");
  $signUpData = new SignUpData($session->hasFlashData() ? $session->GetFlashData() : NULL);
  $session->clearFlashData();
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wedding Board | Sign Up</title>
  
  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lobster Two|Assistant">
  <link href="/css/login/index.css" rel="stylesheet">
</head>
<body>
  <div class="title-banner"><h1><a href="/">Wedding Board</a></h1></div>
  <div class="form-box">
    <h2>Sign Up</h2>
    <form action="verify_signup.php" method="post">
      <div>
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" value="<?=$signUpData->getFirstName()?>" required>
      </div>
      <div>
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" value="<?=$signUpData->getLastName()?>">
      </div>
      <div>
        <label for="username">Username</label>
        <input type="text" name="username" value="<?=$signUpData->getUsername()?>" required>
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" name="password" value="<?=$signUpData->getPassword()?>" required>
      </div>
      <?php 
        if ($signUpData->hasError()) {
          echo "<p>".$signUpData->getError()."<p>";
        }
      ?>
      <input type="submit" value="Sign Up">
    </form>
    <p>Already have an account?&nbsp&nbsp<a href="/login" class="link">Log In</a></p>
  </div>
</body>