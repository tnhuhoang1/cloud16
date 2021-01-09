<?php
    $host = getenv('CLOUDSQL_HOST');
    $username = getenv('CLOUDSQL_USER');
    $password = getenv('CLOUDSQL_PASSWORD');
    $databaseName = getenv('CLOUDSQL_DATABASE_NAME');
    $conn = new mysqli($host, $username, $password, $databaseName);

    if($conn -> connect_error){
        die("connect_failed"); 
    }
?>