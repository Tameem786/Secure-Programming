<?php 
    session_start();
    if(!password_verify($_SESSION["account"], $_SESSION["session_id"])){
        header("Location:index.php");  
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/design.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Profile</title>
</head>
<body background="Resource/ATM.png" style="background-repeat: no-repeat; background-size: cover;">
    <center>
        <div class="center" style="width: 600px;">
            <nav class="navbar navbar-expand-sm bg-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="display.php" target="profileinfo">Display</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="send.php" target="profileinfo">Send Money</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="withdraw.php" target="profileinfo">Withdraw Money</a>
                    </li>
                    <li class="nav-item navbar-right">
                        <a class="nav-link" href="logout.php" target="profileinfo">Logout</a>
                    </li>
                </ul>   
            </nav>
        </div>
        <div>
            <iframe name="profileinfo" width="600px" height="300px" style="background-color:white;"></iframe>
        </div>
    </center>
</body>
</html>