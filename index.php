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
    <div id="content">
        <form name="login" onsubmit="return validateForm()" method="POST">
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