<?php
    session_start();
    
    if(isset($_SESSION['cse-login']) && isset($_SESSION['cse-username'])){
        header("location: main.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div>
        <div class="h-ad-login">
            <form action="" class="h-ad-form" method="POST" onsubmit="return adminLogin(this)">
                <input type="text" name="txt-username" placeholder="Username">
                <input type="text" name="txt-password" placeholder="Password">
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
    <script src="js/js.js">
    </script>
</body>
</html>