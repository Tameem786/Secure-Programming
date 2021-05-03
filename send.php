<?php
    session_start();
    $otp = "";
    for($x=0; $x<6; $x++){
        $otp .= strval(mt_rand(1,9));
    }
    $_SESSION["OTP"] = $otp;
    $_SESSION["EMAIL"] = $_POST["emailaddress"];
    $to_email = $_POST["emailaddress"];
    $subject = "Simple Email Test via PHP";
    $body = "Hi, This is your {$otp}";
    $headers = "From: atmmachine098@gmail.com";
    if (mail($to_email, $subject, $body, $headers)) {
        //echo "Email successfully sent to $to_email...";
        header("Location:otp.php");
        exit;
    } else {
        echo "Email sending failed...";
    }
?>
