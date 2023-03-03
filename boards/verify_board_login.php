<?php

include_once("../session.php");
include_once("../php/board_login.php");

#TODO convert to BoardViewerSession
verify_board_login(new BoardWriterSession(), "/boards/view.php", "/boards/index.php");

?>