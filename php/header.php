<?php
  defined('_HEADER_ACCESS') or exit('Restricted Access');
?>
<nav>
  <ul class="left-nav">
    <li><a class="logo-name" href="/">Wedding Board</a></li>
  </ul>
  <img class="toggle" src="/imgs/menu_bars.svg" alt="Drop Down Menu Bars">
  
  <?php
    if ($loggedIn) {
  ?>
  <ul class="right-nav<?=$loggedIn ? "" : " hidden"?>">
    <li><a href="">My Boards</a></li>
    <li class="logout"><a href="logout" >Log Out</a></li>
  </ul>
  <?php
    }
    else {
  ?>
  <ul class="right-nav">
    <li><a href="">Write a Message</a></li>
    <li><a href="login">Log In</a></li>
  </ul>
  <?php } ?>
</nav>