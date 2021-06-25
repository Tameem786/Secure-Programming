
<!-- <html>
    <head>
        <title>Logout</title>
    </head>
    <body>

    </body>
</html> -->
<?php 
    session_start();
    session_destroy();
    header("Location:index.php");
?>