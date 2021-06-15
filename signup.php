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
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "userdata";
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }else{
                $result1 = $conn->query("SELECT Username FROM Users WHERE Email = '".$_POST["emailaddress"]."'");
                if($result1->num_rows > 0){
                    echo "<script>alert('Email address exists')</script>";
                }else{
                    session_start();
                    $otp = "";
                    for($x=0; $x<6; $x++){
                        $otp .= strval(mt_rand(1,9));
                    }
                    $_SESSION["OTP"] = $otp;
                    $_SESSION["EMAIL"] = $_POST["emailaddress"];
                    $_SESSION["NAME"] = $_POST["fullname"];
                    $to_email = $_POST["emailaddress"];
                    $subject = "Simple Email Test via PHP";
                    $body = "Hi, This is your {$otp}";
                    $headers = "From: atmmachine098@gmail.com";
                    if (mail($to_email, $subject, $body, $headers)) {
                        //echo "Email successfully sent to $to_email...";
                        header("Location:otp.php");
                        exit;
                    } else {
                        echo "<script>alert('Email sending failed...')</script>";
                    }
                }
            }     
        }
    ?>
    <div id="content">
        <form name="signup" method="POST" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
            <div class="form-group">
                <input class="form-control" id="input1" type="text" name="fullname" title="Enter Full Name" placeholder="Enter Full Name" maxlength="20" pattern="[a A-z Z]{6,}" required>
            </div>
            <div class="form-group">
                <input class="form-control" id="input1" type="email" name="emailaddress" title="Enter Email Address" placeholder="Enter Email Address" required>  
            </div>
            <div class="form-group">
                <input type="submit" value="Send OTP" class="btn btn-info">
            </div>
        </form>
        <a href="index.php" id="acolor">Back</a>
    </div>
</body>
</html>