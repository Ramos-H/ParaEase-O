<?php
    if (! empty($_POST) && $_POST['userid'] === 'valid_username' && $_POST['password'] === 'valid_password')
    {
        $_SESSION['logged_in'] = true;
        header('Location: admin.php');
    }
?>
<html>
    <head>
        <title>User Login</title>
    </head>
    <body>
        <form name="frmUser" method="post" action="" align="center">
        <h3 align="center">Enter Login Details</h3>
        Username:<br>
        <input type="text" name="userid">
        <br>
        Password:<br>
        <input type="password" name="password">
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="reset">
        </form>
    </body>
</html>

