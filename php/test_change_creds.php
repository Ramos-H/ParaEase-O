<!DOCTYPE html>
<html>
  <head>
    <title>Change Credentials Test</title>
  </head>
  <body>
    <?php require_once 'logic_change_creds.php'; ?>
    <h2>Current credentials</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
      Old Username: <input type="text" name="username"><br><br>
      Old Password: <input type="text" name="password"><br><br>
      New Username: <input type="text" name="new_username"><br><br>
      New Password: <input type="text" name="new_password"><br><br>
      Confirm Password: <input type="text" name="confirm_password"><br><br>
      <input type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>