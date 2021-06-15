<?php
    session_start();
?>
<html>
    <head>
        <title>Logout</title>
    </head>
    <body>
        <p>Logout Successfully...</p>
    </body>
</html>
<?php 
    session_unset();
    session_destroy();
    header("Location:index.php");
?>