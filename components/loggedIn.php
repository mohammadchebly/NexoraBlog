<?php

if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']){
      header("Location: login.php");
      die();
  }