<?php require_once 'logic_login.php'; ?>
<html>
    <head>
        <title>Admin Login Test</title>
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
    <?php if(isset($errors[0])) { echo $errors[0]; } ?>
    </body>
</html>