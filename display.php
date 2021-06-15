<?php 
    session_start();
    if(!password_verify($_SESSION["account"], $_SESSION["session_id"])){
        header("Location:index.php");  
    }
?>

<html>
    <head>
        <title>Display</title>
    </head>
    <body>
        <p>Display Info</p>
        <?php  
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
                $account = $_SESSION["account"];
                $query = $conn->query("SELECT amount,Username,Email FROM Users WHERE AccountNumber = '".$account."'");
                $row = $query->fetch_assoc();
                $username = $row["Username"];
                $email = $row["Email"];
                $amount = $row["amount"];
                echo "<p>Username: $username</p>";
                echo "<p>Email: $email</p>";
                echo "<p>Account Number: $account</p>";
                echo "<p>Total Balance: $amount RM</p>";
            }
        ?>
    </body>
</html>