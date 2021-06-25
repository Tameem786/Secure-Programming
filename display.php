<?php 
    session_start();
    if(!isset($_SESSION['loggedin'])){
        header("Location:index.php");
        exit;
    }
    include("config.php");
    $account = $_SESSION["account"];
    $sql = $conn->prepare('SELECT amount,Username,Email FROM Users WHERE AccountNumber=?');
    $sql->bind_param('s', $account);
    $sql->execute();
    $sql->bind_result($amount, $username, $email);
    $sql->fetch();
    $sql->close();
?>

<html>
    <head>
        <title>Display</title>
    </head>
    <body>
        <p>Display Info</p>  
        <p>Username: <?=$username?></p>
        <p>Email: <?=$email?></p>
        <p>Account Number: <?=$_SESSION['account']?></p>
        <p>Total Balance: <?=$amount?> RM</p>       
    </body>
</html>