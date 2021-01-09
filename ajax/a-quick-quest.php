<?php
    require_once("../database/database-function.php");
    if(isset($_POST['h-submit-btn'])){
        if(empty($_POST['h-txt-input'])){
            echo "error";
        }else{
            simpleQuery("insert into quick_quest set title = ?",0,[$_POST['h-txt-input']]);
            echo "ok";
        }
    }


?>