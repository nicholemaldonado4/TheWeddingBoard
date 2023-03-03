<?php

include_once("../session.php");
include_once("../php/board_login.php");

verify_board_login(new BoardViewerSession(), "/boards/view.php", "/boards/index.php");

?>