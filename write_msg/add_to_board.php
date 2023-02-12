<?php


include_once("../database.php");
include_once("../session.php");

function get_filename($filename) {
  $path_parts = pathinfo($filename);
  return $path_parts['filename'].'_'.microtime().'_'.$path_parts['extension'];
}

function make_dir($dir) {
  if (!file_exists($dir)) {
    mkdir($dir, 0775, true);
  }
}

function img_uploaded($imgUploadedName) {
  if (!array_key_exists($imgUploadedName, $_FILES)) {
    return "An error occurred when trying to upload the image. Please try again.";
  } 
  switch ($_FILES[$imgUploadedName]["error"]) {
    # Image was uploaded successfully.
    case 0:
      break;
    case 4:
      return "An image must be uploaded.";
    default:
      return "An error occurred when trying to upload the image. Please try again.";
  }
  return TRUE;
}

function add_pic_to_db($filename, $boardPin, $boardMsg) {
  $db = new Database();
  $err  = $db->connect();
  if (!empty($err)) {
    return $err;
  }
  
  $stmt = $db->getCon()->prepare("INSERT INTO PICTURE (PFilePath, PPin, PCaption) VALUES (?,?,?)");
  $stmt->bind_param('sss', $filename, $boardPin, $boardMsg);
  if ($stmt->execute() == FALSE) {
    return "An error occurred. Please try again.";
  }
  return TRUE;
}

function add_to_board() {
  if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: .");
    exit();
  }
  $session = new BoardWriterSession();
  
  if (!array_key_exists("board_msg", $_POST) || trim($_POST["board_msg"]) === '') {
    $session->SetFlashData(new FlashData("A message must be provided.",["was_uploaded"=>FALSE]));
    header("Location: write.php");
    exit();
  }
  
  $boardMsg = $_POST["board_msg"];
  $imgUploadedName = "file_img";
  
  if (($err = img_uploaded($imgUploadedName)) !== TRUE) {
    $session->SetFlashData(new FlashData($err,["board_msg"=>$boardMsg, "was_uploaded"=>FALSE]));
    header("Location: write.php");
    exit();
  }
  
  # Save file to the ../uploaded/<board_pin> directory.
  $filename = get_filename($_FILES[$imgUploadedName]["name"]);
  $dir = "../uploaded/".$session->getBoardPin();
  make_dir($dir);
  if (!move_uploaded_file($_FILES[$imgUploadedName]["tmp_name"], $dir."/".$filename)) {
    $session->setFlashData(new FlashData('An error occured. Please try again.', 
                                     ["board_msg"=>$boardMsg, "was_uploaded"=>FALSE]));
    header("Location: write.php");
    exit();
  }
  
  # Add the picture info to the PICTURE db.
  if (($err = add_pic_to_db($filename, $session->GetBoardPin(), $boardMsg)) !== TRUE) {
    unlink($dir."/".$filename);
    $session->setFlashData(new FlashData($err, 
                                     ["board_msg"=>$boardMsg, "was_uploaded"=>FALSE]));
  } else {
    $session->setFlashData(new FlashData('Success! Your message was added.', ["was_uploaded"=>TRUE]));
  }  
  header("Location: write.php");
  exit();
}

add_to_board();
?>