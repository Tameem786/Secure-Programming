<?php 
    session_start();
    if(!password_verify($_SESSION["account"], $_SESSION["session_id"])){
        header("Location:index.php");  
    }
?>

<html>
    <head>
        <title>Send</title>
    </head>
    <body>
        <p>Send money</p>
        <form action="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <input type="text" name="accountnumber" placeholder="Enter reciever account number" size="25" pattern="[0-9]{10}" required> <br> <br>
            <input type="number" name="amount" placeholder="Enter amount" required> <br> <br>
            <input type="submit">
        </form>
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
                    $receiver = $_POST["accountnumber"];
                    $amount = $_POST["amount"];
                    $sender = $_SESSION["account"];
                    $result = $conn->query("SELECT amount FROM Users WHERE AccountNumber = '".$receiver."'");
                    if($result->num_rows > 0){
                        $newquery = $conn->query("SELECT amount FROM Users WHERE AccountNumber = '".$sender."'");
                        $rowss = $newquery->fetch_assoc();
                        $senderamount = $rowss["amount"];
                        if($senderamount >= $amount){
                            $sendernewamount = $senderamount - $amount;
                            $row = $result->fetch_assoc();
                            $newamount = $row["amount"] + $amount;
                            $query = $conn->query("UPDATE Users SET amount=$newamount WHERE AccountNumber='".$receiver."'");
                            if($query){
                                $query1 = $conn->query("UPDATE Users SET amount=$sendernewamount WHERE AccountNumber='".$sender."'");
                                if($query1){
                                    echo "<p>Money send successfully</p>";
                                    echo "<p>You have $sendernewamount RM left</p>";
                                }
                            }else{
                                echo "<p>Money can not send</p>";
                            }
                        }else{
                            echo "<p>You don't have sufficient amount</p>";
                        }
                    }else{
                        echo "<p>Account number is not found.</p>";
                    }
                }
            }
        ?>
    </body>
</html>