<?php 
  include_once("../session.php");
  include_once("../database.php");

  class Post {
    private $msg;
    private $filepath;
    private $directory;
    function __construct($msg, $filepath) {
      $this->msg = $msg;
      $this->filepath = $filepath;
    }
    
    function get_msg() {
      return $this->msg;
    }
    function get_filepath() {
      return $this->filepath;
    }
  }

  class BoardFeatures {
    private $title;
    private $posts;
    
    function __construct($title) {
      $this->title = $title;
      $this->posts = array();
    }
    
    function set_title($title) {
      $this->title = $title;
    }
    function get_title() {
      return $this->title;
    }
    function get_posts() {
      return $this->posts;
    }
    function add_post($post) {
      $this->posts[] = $post;
    }
  }

  function get_board_title($db, $board_pin) {
    $stmt = $db->getCon()->prepare("SELECT WBannerTitle FROM WEDDING_BOARD WHERE WPin=?");
    $stmt->bind_param('s', $board_pin);
    if ($stmt->execute() == false) {
      return false;
    }

    $resultBoard = $stmt->get_result();
    if ($resultBoard !== false && $resultBoard->num_rows > 0) {
      $row = $resultBoard->fetch_assoc();
      return $row['WBannerTitle'];
    }
    return false;
  }

  function get_board_posts($board_features, $db, $board_pin) {
    $stmt = $db->getCon()->prepare("SELECT PFilePath, PCaption FROM PICTURE WHERE PPin=?");
    $stmt->bind_param('s', $board_pin);
    if ($stmt->execute() == false) {
      return false;
    }
    $resultBoard = $stmt->get_result();
    if ($resultBoard !== false) {
      while ($row = $resultBoard->fetch_assoc()) {
        $board_features->add_post(new Post($row['PCaption'], "../uploaded/".$board_pin."/".$row['PFilePath']));
      }
      return true;
    }
    return false;
  }
  
  function get_board_features($board_pin) {
    $db = new Database();
    if (!empty($db->connect())) {
      return false;
    }
    $title = get_board_title($db, $board_pin);
    if ($title === false) {
      return false;
    }
    $board_features = new BoardFeatures($title);
    return get_board_posts($board_features, $db, $board_pin) ? $board_features : false;
  }
?>