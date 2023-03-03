<?php 
  include_once("../session.php");
  define('_HEADER_ACCESS', 1);
  $session = new BoardViewerSession();
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
  <?php require_once '../php/logout_header.php';?>
  <section class="msg-sect">

  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="/js/header.js"></script>
  <script src="/js/write_msg/write.js"></script>
</body>