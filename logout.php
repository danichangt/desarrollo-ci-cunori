<?php 

    require 'database.php';
    
    session_unset();

    session_destroy();
  
    header('Location: login.php');
?>