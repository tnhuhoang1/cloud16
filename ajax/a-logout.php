<?php
    session_start();
    if(isset($_SESSION['username'])){
        if(isset($_POST['logout'])){
            session_destroy();
            echo 'ok';
        }else{
            header("location: ../forum.php");
        }
        
    }else{
        header("location: ../forum.php");
    }
    
?>