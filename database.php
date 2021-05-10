<?php
    $server = 'localhost:3306';
    $username = 'root';
    $password = '@@Kyubi07@@';
    $database = 'ci_cunori';

    try{
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    }catch(PDOException $e){
        die('Falló la conexion: '.$e->getMessage());
    }
?>