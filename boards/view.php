<?php 
  include_once("../session.php");
  include_once("board_features.php");
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
  <link href="/css/boards/dynamic_view.php" type='text/css' rel="stylesheet">
  <link href="/css/header.css" rel="stylesheet">
  <link href="/css/grey_scale_header.css" rel="stylesheet">
  
</head>
<body>
  <?php require_once '../php/logout_header.php';?>
  <?php
    #TODO: Create closable banner displaying err.
    if ($session->hasFlashData()) {
      $session->clearFlashData();
    }
    $board_features = get_board_features($session->getBoardPin()); 
    # TODO if $board_features === FALSE, don't print anything.
  ?>
  <h1><?=$board_features->get_title()?></h1>
  <section class="gallery">
    <?php
      $posts = $board_features->get_posts();
      foreach ($posts as $post) {
    ?>
        <figure class="post-img">
          <img src="<?=$post->get_filepath()?>">
        </figure>
        <span class="post-msg">
          <p><?=$post->get_msg()?></p>  
        </span>
    <?php
      }
    ?>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="/js/header.js"></script>
  <script src="/js/write_msg/write.js"></script>
</body>