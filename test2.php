<?php

use Symfony\Component\VarDumper\VarDumper;

require_once("./admin/upload-file.php");
    if(isset($_POST['ok'])){
        // $i = uploadFile($_FILES['files'], "admin/uploads/");
        // echo $i;
        var_dump($_FILES);
    }
    echo dirname(realpath(__FILE__));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="files">
        <input type="submit" name="ok" value="ok">
    </form>
</body>
</html>
