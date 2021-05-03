<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/design.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="JS/scripts.js"></script>
    <title>ATM</title>
</head>
<body background="Resource/ATM.png" style="background-repeat: no-repeat; background-size: cover;">
    <?php
        session_start();
        $accnum = "";
        $pinnum = "";
        for($x=0; $x<10; $x++){
            $accnum .= strval(mt_rand(1,9));
        }
        for($y=0; $y<8; $y++){
            $pinnum .= strval(mt_rand(1,9));
        }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $typedotp = $_POST["otp"];
            if($typedotp != ""){
                if($typedotp == $_SESSION["OTP"]){
                    $to_email = $_SESSION["EMAIL"];
                    $subject = "Simple Email Test via PHP";
                    $body = "Account Number: {$accnum} \n PIN Number: {$pinnum}";
                    $headers = "From: atmmachine098@gmail.com";
                    if (mail($to_email, $subject, $body, $headers)) {
                        header("Location:mainpage.php");
                        exit;
                    } else {
                        echo "Email sending failed...";
                    }
                }
                else{
                    echo '<script>alert("Enter valid PIN")</script>';
                }
            }
        }
    ?>
    <div id="content">
        <form name="validOTP" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> onsubmit="return validateForm()" method="POST">
            <div class="form-group">
                <input class="form-control" id="input1" type="text" name="otp" title="Enter OTP" placeholder="Enter OTP" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Sign Up" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>