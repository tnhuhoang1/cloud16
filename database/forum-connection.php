<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "forum";
    $conn = new mysqli($host, $username, $password, $databaseName);

    if($conn -> connect_error){
        die("connect_failed"); 
    }
?>