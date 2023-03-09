<?php 
  # https://css-tricks.com/css-variables-with-php/
  header("Content-type: text/css");

  include_once("../../session.php");
  include_once("../../database.php");

  class BoardSettings {
    private $background_color;
    private $foreground_color;
    private $font_color;
    private $is_honeycomb_shape;
    
    function __construct($background_color = "#ffffff", $foreground_color = "#5fc8cc", $font_color = "#ffffff", $is_honeycomb_shape = false) {
      $this->background_color = $background_color;
      $this->foreground_color = $foreground_color;
      $this->font_color = $font_color;
      $this->is_honeycomb_shape = $is_honeycomb_shape;
    }
    
    function get_background_color() {
      return $this->background_color;
    }
    function get_foreground_color() {
      return $this->foreground_color;
    }
    function get_font_color() {
      return $this->font_color;
    }
    function is_honeycomb_shape() {
      return $this->is_honeycomb_shape;
    }
    function print() {
      echo "back: ".$this->background_color."<br>";
      echo "fore: ".$this->foreground_color."<br>";
      echo "font: ".$this->font_color."<br>";
      echo "honeycomb: ".$this->is_honeycomb_shape."<br>";
    }
    function get_rgb_foreground() {
      $r = hexdec(substr($this->foreground_color,0,2));
      $g = hexdec(substr($this->foreground_color,2,2));
      $b = hexdec(substr($this->foreground_color,4,2));
      return array($r, $g, $b);
    }
  }
  
  function get_board_settings() {
    $session = new BoardViewerSession();
    $db = new Database();
    $err  = $db->connect();
    if (!empty($err)) {
      $session->setFlashData(new FlashData("Unable to load board settings. Please try to reload the page"));
      return new BoardSettings();
    }

    $stmt = $db->getCon()->prepare("SELECT * FROM WEDDING_BOARD WHERE WPin=?");
    $stmt->bind_param('s', $session->getBoardPin());
    if ($stmt->execute() == FALSE) {
      $session->setFlashData(new FlashData("Unable to load board settings. Please try to reload the page"));
      return new BoardSettings();
    }

    $resultBoard = $stmt->get_result();
    if ($resultBoard !== FALSE && $resultBoard->num_rows > 0) {
      $row = $resultBoard->fetch_assoc();
      return new BoardSettings("#".$row['WBackgroundColor'],
                              "#".$row['WForegroundColor'],
                              "#".$row['WFontColor'],
                              $row['WIsHoneyCombShape']);
    }
    $session->setFlashData(new FlashData("Unable to load board settings. Please try to reload the page"));
    return new BoardSettings();
  }
  
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