<?php 
  # https://css-tricks.com/css-variables-with-php/
  header("Content-type: text/css");

  include_once("../../php/board_settings.php");

  $board_settings = get_board_settings();

?>

:root {
  --charcoal: #454647;
  --light-grey: #d1d4d9;
  --med-teal: #40aa9c;
  --light-teal: #53cfbe;
  --dark-teal: #338f82;
  
  --light-aqua: #67d7db;
  --med-aqua: #5fc8cc;
  
  --ff-title: "Lobster Two", serif;
  --ff-body: "Assistant", "sans-serif";
}

body {
  background-color: <?=$board_settings->get_background_color();?>
}

.post-overlay {
  background-color: <?php
    list($r, $g, $b) = $board_settings->get_rgb_foreground();
    echo "rgba($r, $g, $b, 0.8)";
  ?>;
}

.post-msg {
  color: <?=$board_settings->get_font_color();?>;
}