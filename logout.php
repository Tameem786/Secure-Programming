<?php
    session_start();
?>
<html>
    <head>
        <title>Logout</title>
    </head>
    <body>
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
                $query = $conn->query("UPDATE Users SET signin=0 WHERE AccountNumber = '".$account."'");
                if($query){
                    echo "<p>Logout Successfully...</p>";
                }
            }

        ?>
    </body>
</html>
<?php 
    session_unset();
    session_destroy();
    header("Location:index.php");
?>