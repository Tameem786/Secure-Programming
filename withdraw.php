<?php 
    session_start();
    if(!isset($_SESSION['loggedin'])){
        header("Location:index.php");
        exit;
    }
?>

<html>
    <head>
        <title>Withdraw</title>
    </head>
    <body>
        <p>Withdraw money</p>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <input type="number" name="withdrawamount" placeholder="Enter ammount" required>
            <input type="submit">
        </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["withdrawamount"])){
                include("config.php");
                $amount = $_POST["withdrawamount"];
                $account = $_SESSION["account"];
                $sql = $conn->prepare('SELECT amount FROM Users WHERE AccountNumber=?');
                $sql->bind_param('s', $account);
                $sql->execute();
                $sql->bind_result($current_amount);
                $sql->fetch();
                $sql->close();
                // $query = $conn->query("SELECT amount FROM Users WHERE AccountNumber='".$account."'");
                // $row = $query->fetch_assoc();
                if($amount > $current_amount){
                    echo "<p>You don't have sufficient balance.</p>";
                }else{
                    $newamount = $current_amount - $amount;
                    $sql = $conn->prepare('UPDATE Users SET amount=? WHERE AccountNumber=?');
                    $sql->bind_param('ds', $newamount, $account);
                    $sql->execute();
                    // $result = $conn->query("UPDATE Users SET amount=$newamount WHERE AccountNumber='".$account."'");
                    if($sql){
                        echo "<p>Take your money</p>";
                        echo "<p>Money left: $newamount</p>";
                    }else{
                        echo "<script>alert('Can not process money withdrawal!')</script>";
                    }
                    $sql->close();
                }
            }else{
                echo "<p>Empty Input</p>";
            }
        ?>
    </body>
</html>