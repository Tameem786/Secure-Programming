<?php
    $to_email = "tameemturag@gmail.com";
    $subject = "Simple Email Test via PHP";
    $body = "Hi, This is your OPT";
    $headers = "From: atmmachine098@gmail.com";

    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";
    }
?>
