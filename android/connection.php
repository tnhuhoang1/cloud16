<?php
    // $host = getenv('CLOUDSQL_HOST');
    // $username = getenv('CLOUDSQL_USER');
    // $password = getenv('CLOUDSQL_PASSWORD');
    // $databaseName = getenv('CLOUDSQL_DATABASE_NAME');
    $host = '35.240.142.161';
    $username = 'root';
    $password = 'database16';
    $databaseName = 'forum';
    $conn = new mysqli($host, $username, $password, $databaseName);


    // $dbConn = 'cloud-16:asia-southeast1:database16';
    // $dbName = 'forum';
    // $dbUser = 'root';
    // $dbPass = 'database16';
    // $dsn = "mysql:unix_socket=/cloudsql/${dbConn};dbname=${dbName}";
    // $conn = new PDO($dsn, $dbUser, $dbPass);
    // $conn = new mysqli(null, $username, $password, $databaseName, null, $dsn);


    if($conn -> connect_error){
        // var_dump($_SERVER);
        // echo("/n");
        echo($password);
        // var_dump($conn);
        die("connect_failed"); 
    }
?>