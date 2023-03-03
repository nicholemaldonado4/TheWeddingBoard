<?php

include_once("../session.php");
include_once("../php/board_login.php");

verify_board_login(new BoardWriterSession(), "/write_msg/write.php", "/write_msg/index.php");

?>