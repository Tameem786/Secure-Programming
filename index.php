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
            }
            if(isset($_POST["account"], $_POST["pin"])) 
            {     
                $account = $_POST["account"]; 
                $pin = $_POST["pin"]; 

                $result1 = $conn->query("SELECT AccountNumber, PIN FROM Users WHERE AccountNumber = '".$account."' AND  PIN = '".$pin."'");

                if($result1->num_rows > 0 )
                { 
                    //$_SESSION["logged_in"] = true; 
                    echo "<script>alert('Logged In Successfully!')</script>";
                }
                else
                {
                    echo "<script>alert('The username or password are incorrect!')</script>";
                }
            }
        } 
    ?>
    <div id="content">
        <form name="login" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> onsubmit="return validateForm()" method="POST">
            <div class="form-group">
                <input class="form-control" id="input1" type="text" name="account" title="Enter Account Number" placeholder="Enter Account Number" required>
            </div>
            <div class="form-group">
                <input class="form-control" id="input1" type="password" name="pin" title="Enter PIN Number" placeholder="Enter PIN Number" required>
            </div>
            <div class="form-group">
                <table>
                    <th><input type="submit" class="btn btn-primary" value="Login"></th>
                    <th style="width: 100px;"></th>
                    <th style="width: 100px;"></th>
                    <th style="width: 100px;"></th>
                    <th><a href="signup.php"><input type="button" class="btn btn-primary" value="Create an Account"></a></th>
                </table>
            </div>
        </form>
    </div>
</body>
</html>