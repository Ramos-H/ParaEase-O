<!DOCTYPE html>
<html>
  <head>
    <title>Change Credentials Test</title>
  </head>
  <body>
    <h2>Current credentials</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
      Old Username: <input type="text" name="username"><br><br>
      Old Password: <input type="text" name="password"><br><br>
      New Username: <input type="text" name="new_username"><br><br>
      New Password: <input type="text" name="new_password"><br><br>
      Confirm Password: <input type="text" name="confirm_password"><br><br>
      <input type="submit" name="submit" value="Submit">
    </form>

    <?php
      require_once 'utils.php';
      require_once 'database.php';
      require_once 'constants.php';

      if(isset($_POST['submit'])) // when user submit POST request
      {
        $username         = isset($_POST['username'])         ? trim($_POST['username'])         : null;
        $password         = isset($_POST['password'])         ? trim($_POST['password'])         : null;
        $new_username     = isset($_POST['new_username'])     ? trim($_POST['new_username'])     : null;
        $new_password     = isset($_POST['new_password'])     ? trim($_POST['new_password'])     : null;
        $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : null;

        $has_username         = !check_str_empty($username);
        $has_password         = !check_str_empty($password);
        $has_new_username     = !check_str_empty($new_username);
        $has_new_password     = !check_str_empty($new_password);
        $has_confirm_password = !check_str_empty($confirm_password);

        $new_username_too_long  = (strlen($new_username) > MAX_LENGTH_FIELD);
        $new_password_too_short = (strlen($new_password) < MIN_LENGTH_PASSWORD);

        if(DEBUG_MODE)
        {
          echo sprintf('Has username: %s<br>',         boolToStr($has_username));
          echo sprintf('Has password: %s<br>',         boolToStr($has_password));
          echo sprintf('Has new username: %s<br>',     boolToStr($has_new_username));
          echo sprintf('Has new password: %s<br>',     boolToStr($has_new_password));
          echo sprintf('Has confirm password: %s<br>', boolToStr($has_confirm_password));
        }

        $errors = array('username' => '', 
                        'password' => '', 
                        'new_username' => '' , 
                        'new_password' => '' , 
                        'confirm_password' => ''); // array containing errors

        if(!$has_username) { $errors['username'] = 'Username cannot be empty'; } // old name req *
        if(!$has_password) { $errors['password'] = 'Password cannot be empty'; } // old pass req *
        
        if($new_username_too_long) { $errors['new_username'] = 'Error! New username too long'; } // more than 30 chars not allowed *
        
        if($has_new_password)
        {
          if($new_password_too_short) { $errors['new_password'] = 'Error! New password must be at least 8 characters'; } // min 8 chars req *

          if(!$has_confirm_password) { $errors['confirm_password'] = 'Confirm cannot be empty'; } //  confirm pass req if new pass is existing *
          elseif($new_password !== $confirm_password) { $errors['confirm_password'] = 'New password and confirm password does not match'; } // new password and confirm must match *
        }

        if($has_username && $has_password)
        {
          if(!verify_credentials($username, $password))
          {
            echo 'Invalid credentials. <br>';
          }
          else
          {
            if($has_new_username || ($has_new_password && $has_confirm_password && $new_password === $confirm_password))
            {
              update_credentials($new_username, $new_password);
            }
          }
        }

        if(!check_str_empty($errors['username']))         { echo sprintf('%s<br>', $errors['username']); }
        if(!check_str_empty($errors['password']))         { echo sprintf('%s<br>', $errors['password']); }
        if(!check_str_empty($errors['new_username']))     { echo sprintf('%s<br>', $errors['new_username']); }
        if(!check_str_empty($errors['new_password']))     { echo sprintf('%s<br>', $errors['new_password']); }
        if(!check_str_empty($errors['confirm_password'])) { echo sprintf('%s<br>', $errors['confirm_password']); }
      }
    ?>
  </body>
</html>