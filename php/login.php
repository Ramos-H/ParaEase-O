<?php
    session_start();
    if (!empty($_POST) && trim($_POST['username']) === 'valid_username' && trim($_POST['password']) === $newpw)
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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" align="center">
        <h3 align="center">Enter Login Details</h3>
        Username:<br>
        <input type="text" name="username">
        <br>
        Password:<br>
        <input type="password" name="password">
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset">
        </form>
    <?php
        if(isset($_POST['submit'])) {
            if (empty(trim($_POST['username'])) && empty(trim($_POST['password']))){
                echo "<center>Please enter your username and password.</center>";
            }
            else if (empty(trim($_POST['username'])) || empty(trim($_POST['password']))){
                echo "<center>Invalid Credentials.</center>";
            }
            else if (trim($_POST['username']) !== 'valid_username' && trim($_POST['password']) !=='valid_password' ){
                echo "<center>Invalid Credentials.</center>";
            }   
        }   
    ?>
    </body>
</html>