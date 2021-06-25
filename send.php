<?php 
    session_start();
    if(!isset($_SESSION['loggedin'])){
        header("Location:index.php");
        exit;
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
            if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["accountnumber"], $_POST["amount"])){
                include("config.php");           
                $receiver = $_POST["accountnumber"];
                $amount = $_POST["amount"];
                $sender =  $_SESSION["account"];
                $sql = $conn->prepare('SELECT amount FROM Users WHERE AccountNumber=?');
                $sql->bind_param('s', $receiver);
                $sql->execute();
                $sql->store_result();
                $sql->bind_result($receiveramount);
                $sql->fetch();
               
                if($sql->num_rows > 0){
                    $sql->bind_param('s', $sender);
                    $sql->execute();
                    $sql->store_result();
                    $sql->bind_result($senderamount);
                    $sql->fetch();
                    $sql->close();

                    if($senderamount >= $amount){
                        $sendernewamount = $senderamount - $amount;
                        $receivernewamount = $receiveramount+$amount;

                        $sql = $conn->prepare('UPDATE Users SET amount=? WHERE AccountNumber=?');
                        $sql->bind_param('ds', $receivernewamount , $receiver);
                        $sql->execute();
                        
                        $sql->bind_param('ds', $sendernewamount , $sender);
                        $sql->execute();

                        echo "<p>Money send successfully</p>";
                        echo "<p>You have $sendernewamount RM left</p>";         
                        $sql->close();
                    }else{
                        echo "<p>You don't have sufficient amount</p>";
                    }
                }else{
                    echo "<p>Account number is not found.</p>";
                }  
            }else{
                echo "<p>Wrong Input</p>";
            }
        ?>
    </body>
</html>