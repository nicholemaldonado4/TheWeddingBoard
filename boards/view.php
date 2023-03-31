<?php 
  include_once("../session.php");
  include_once("board_features.php");
  include_once("../php/gallery.php");
  define('_HEADER_ACCESS', 1);

  $session = new BoardViewerSession();
  $session->redirectIfNotLoggedIn(".");
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wedding Board | View</title>
  
  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lobster Two|Assistant">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <link href="/css/boards/dynamic_view.php" type='text/css' rel="stylesheet">
  <link href="/css/header.css" rel="stylesheet">
  <link href="/css/boards/view.css" rel="stylesheet">
  <link href="/css/grey_scale_header.css" rel="stylesheet">
  
</head>
<body>
  <?php require_once '../php/logout_header.php';?>
  <section class="banner">
    <?php
      $alert_msgs = array();
      if ($session->hasFlashData()) {
        
        $alert_msgs[] = $session->getFlashData()->getMsg();
        $session->clearFlashData();
      }
      $board_features = get_board_features($session->getBoardPin());
      if ($board_features === FALSE) {
        $alert_msgs[] = "Unable to get board messages. Please try again.";
      }

      if (!empty($alert_msgs)) {
    ?>
      <div class="alerts">
        <?php foreach ($alert_msgs as $msg) {?>
          <div class="alert-item">
            <p><?=$msg?></p>
            <span class="closebtn">&times;</span> 
          </div>
        <?php } ?>
      </div>
    <?php } ?>
    
    <h1><?=$board_features === FALSE ? "" : $board_features->get_title()?></h1>
  </section>
  <section class="gallery">
    <?php show_gallery($board_features);?>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="/js/header.js"></script>
  <script src="/js/boards/view.js"></script>
</body>