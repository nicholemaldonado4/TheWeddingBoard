<?php 

  include_once(dirname(__FILE__)."/../session.php");
  include_once(dirname(__FILE__)."/../database.php");

  class BoardSettings {
    private $background_color;
    private $foreground_color;
    private $font_color;
    
    function __construct($background_color = "#ffffff", $foreground_color = "#5fc8cc", $font_color = "#ffffff") {
      $this->background_color = $background_color;
      $this->foreground_color = $foreground_color;
      $this->font_color = $font_color;
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

    function print() {
      echo "back: ".$this->background_color."<br>";
      echo "fore: ".$this->foreground_color."<br>";
      echo "font: ".$this->font_color."<br>";
    }
    function get_rgb_foreground() {
      $r = hexdec(substr($this->foreground_color,0,2));
      $g = hexdec(substr($this->foreground_color,2,2));
      $b = hexdec(substr($this->foreground_color,4,2));
      return array($r, $g, $b);
    }
  }

  function load_board_settings() {
    $session = new BoardViewerSession();
    $db = new Database();
    $err  = $db->connect();
    if (!empty($err)) {
      $session->setFlashData(new FlashData("Unable to load board settings. Please try to reload the page"));
      return new BoardSettings();
    }

    $stmt = $db->getCon()->prepare("SELECT * FROM WEDDING_BOARD WHERE WPin=?");
    $board_pin = $session->getBoardPin();
    $stmt->bind_param('s', $board_pin);
    if ($stmt->execute() == FALSE) {
      $session->setFlashData(new FlashData("Unable to load board settings. Please try to reload the page"));
      return new BoardSettings();
    }

    $resultBoard = $stmt->get_result();
    if ($resultBoard !== FALSE && $resultBoard->num_rows > 0) {
      $row = $resultBoard->fetch_assoc();
      return new BoardSettings("#".$row['WBackgroundColor'],
                              "#".$row['WForegroundColor'],
                              "#".$row['WFontColor']);
    }
    $session->setFlashData(new FlashData("Unable to load board settings. Please try to reload the page"));
    return new BoardSettings();
  }

?>