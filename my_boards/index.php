<?php 
  include_once("get_boards.php");
  include_once("../session.php");
  $session = new Session();
  $session->redirectIfNotLoggedIn("../");
  $loggedIn = True;
  define('_HEADER_ACCESS', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Wedding Board | My Boards</title>
  
  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lobster Two|Assistant">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/my_boards/index.css">
</head>
<body>
  <?php require_once '../php/header.php';?>
  <section class="my-board-header">
    <h2>My Boards</h2>
  </section>
  <section class="my-board-sect">
    <table>
    <thead>
      <tr>
        <th scope="col">Board</th>
        <th scope="col">Pin</th>
        <th scope="col">Password</th>
<!--
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
-->
        <th scope="col">Actions</th>
      <tr>
    </thead>
    <tbody>
      <?php
        get_boards($session);
      ?>
    </tbody>
    </table>
    <?php
      if ($session->hasFlashData()) {
        echo "<p>".$session->getFlashData()->getMsg()."</p>";
        $session->clearFlashData();
      }
    ?>
  </section>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="../js/header.js"></script>
</body>