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
        try{
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                include("config.php");
                if(isset($_POST["account"], $_POST["pin"])) 
                {     
                    $accountname = $_POST["account"]; 
                    // $pin = $_POST["pin"]; 
                    // $result1 = $conn->query("SELECT AccountNumber, PIN, signin FROM Users WHERE AccountNumber='".$account."' AND PIN='".$pin."'");
                    // $row = $result1->fetch_assoc();
                    if($sql = $conn->prepare('SELECT PIN FROM Users WHERE AccountNumber=?')){
                        $sql->bind_param('s', $accountname);
                        $sql->execute();
                        $sql->store_result();
                        if($sql->num_rows > 0)
                        {
                            $sql->bind_result($pin);
                            $sql->fetch();
                            if(password_verify($_POST['pin'], $pin)){
                                session_regenerate_id();
                                $_SESSION['loggedin'] = TRUE;
                                $_SESSION['account'] = $_POST['account'];
                                header("Location:profile.php");
                                exit;                        
                            }else{
                                echo "<script>alert('Incorrect Password!')</script>";
                            }
                        }else{   
                            echo "<script>alert('User not found!')</script>";
                        }
                        $sql->close();
                    }else{
                        echo "<script>alert('Database Error!')</script>";
                    }
                }else{
                    header("Location:index.php");
                }
            }
        }catch(Exception $e){
            header("Location:index.php");
        }
    ?>
    <div id="content">
        <form name="login" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> onsubmit="return validateForm()" method="POST">
            <div id="attemp"></div>
            <div class="form-group">
                <input class="form-control" id="input1" type="text" name="account" title="Enter Account Number" placeholder="Enter Account Number" pattern="[0-9]{10}" required>
            </div>
            <div class="form-group">
                <input class="form-control" id="input2" type="password" name="pin" title="Enter PIN Number" placeholder="Enter PIN Number" pattern="[0-9]{8}" required>
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