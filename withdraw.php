<?php 
    session_start();
    if(!password_verify($_SESSION["account"], $_SESSION["session_id"])){
        header("Location:index.php");  
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
                    $amount = $_POST["withdrawamount"];
                    $account = $_SESSION["account"];
                    $query = $conn->query("SELECT amount FROM Users WHERE AccountNumber = '".$account."'");
                    $row = $query->fetch_assoc();
                    if($amount > $row["amount"]){
                        echo "<p>You don't have sufficient balance.</p>";
                    }else{
                        $newamount = $row["amount"] - $amount;
                        $result = $conn->query("UPDATE Users SET amount=$newamount WHERE AccountNumber = '".$account."'");
                        if($result){
                            echo "<p>Take your money</p>";
                            echo "<p>Money left: $newamount</p>";
                        }else{
                            echo "<script>alert('Can not process money withdrawal!')</script>";
                        }
                    }
                }
            }
        ?>
    </body>
</html>