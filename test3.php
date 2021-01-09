<?php
require_once("./database/database-function.php");
    $sql = "select * from users";
    class User{
        public $user;
        public function __construct($sql){
            global $user;
            $d = array();
            $u = simpleQuery($sql);
            foreach($u as $v){
                $d += [$v['user_id'] => $v];
            }
            $this -> user = $d;
            
        }
        public function getUser($id){
            return $this -> user[$id];
        }

        

    }
    $user1234 = new User($sql);
    cout($user1234 -> getUser('21'));

    if(isset($_POST["content"])){
        $d = htmlspecialchars($_POST["content"]);
        var_dump($d);
        echo htmlspecialchars_decode($d);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CKEditor 5 – Classic editor</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
</head>
<body>
    <h1>Classic editor</h1>
    <form action="test3.php" method="POST">
        <textarea id="editor" name="content">
            <p>This is some sample content.</p>
        </textarea>
        <input type="submit" value="sub">
    </form>
    
    
    <button onclick="xem()">xem</button>
    <script>
        ClassicEditor
         .create( document.querySelector( '#editor' ), {
             ckfinder: {
                 uploadUrl: '/www/preject/CSE485_1851061587_TranNhuHoang/3.PROJECT/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
             },
             
             toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
         }
         
         
         )
         .catch( function( error ) {
             console.error( error );
         } );

         function xem(){
             var s = document.getElementById("editor");
             alert(s.getData());
         }
    </script>
</body>
</html>