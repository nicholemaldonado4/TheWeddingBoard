<?php 
  include_once("../../session.php");
  include_once("../../php/board_settings.php");
  include_once("../../boards/board_features.php");
  include_once("../../php/gallery.php");

  $session = new BoardMakerSession();
  $session->redirectIfNotLoggedIn("../../");

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!array_key_exists("pin", $_POST)) {
      header("Location: ../");
      exit();
    }
    $session->markEditingBoardPin($_POST["pin"]);
  } elseif (!$session->hasEditingBoardPin()) {
    header("Location: ../");
    exit();
  }

  $loggedIn = True;
  define('_HEADER_ACCESS', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Wedding Board | Customize</title>
  
  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lobster Two|Assistant">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="../../css/header.css">
  <link rel="stylesheet" href="../../css/my_boards/customize/index.css">
  <link rel="stylesheet" href="../../css/boards/gallery.css">
</head>
<body>
  <?php 
    require_once '../../php/header.php';
  ?>
  <section class="customize-sect">
    <div class="board-settings-sect">
      <form class="board-settings" method="post" action="update_board.php">
        <?php
          $board_settings = load_board_settings($session, $session->getEditingBoardPin());
        ?>
        <div>
          <label for="title">Banner Title</label>
          <input type="text" name="title" value=<?=$board_settings->get_banner_title();?>>
          <label for="msg_font_color">Message Font Color</label>
          <input type="color" name="msg_font_color" value="<?=$board_settings->get_font_color();?>">

          <label for="background_color">Background Color</label>
          <input type="color" name="background_color" value="<?=$board_settings->get_background_color();?>">
          <label for="foreground_color">Foreground Color</label>
          <input type="color" name="foreground_color" value="<?=$board_settings->get_foreground_color();?>">
        </div>
        <div>
          <input class="submit_btn" type="submit" value="Save Board">
        </div>
      </form>
    </div>
    <div class="board-view">
      <div class="banner">
        <h1><?=$board_settings->get_banner_title()?></h1>
      </div>
      <div class="gallery">
      <?php
        $board_features = get_board_features($session->getEditingBoardPin(), "../../");
        if ($board_features !== FALSE) {
          show_gallery($board_features);
        }
      ?>
      </div>
    </div>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="../../js/header.js"></script>
  <script src="../../js/my_boards/customize/index.js"></script>
</body>