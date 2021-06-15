<?php
    $server = 'localhost:3306';
    $username = 'root';
    $password = '@@Kyubi07@@';
    $database = 'ci_cunori';


    session_start();
    
    $conn = mysqli_connect(
        'localhost:3306',
        'root',
        '@@Kyubi07@@',
        'ci_cunori'
      ) or die(mysqli_erro($mysqli));
?>