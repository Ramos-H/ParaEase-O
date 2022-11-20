<!DOCTYPE html>
<html>
  <head>
    <title>Change Credentials Test</title>
  </head>
  <body>
    <h2>Current credentials</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
      Old Username: <input type="text" name="oldName"><br><br>
      Old Password: <input type="text" name="oldPass"><br><br>
      New Username: <input type="text" name="newName"><br><br>
      New Password: <input type="text" name="newPass"><br><br>
      Confirm Password: <input type="text" name="newPassTwo"><br><br>
      <input type="submit" name="submit" value="Submit">
    </form>

    <?php
      require_once 'utils.php';
      require_once 'database.php';
      require_once 'constants.php';

      if(isset($_POST['submit'])) // when user submit POST request
      {
        $username         = isset($_POST['oldName'])    ? trim($_POST['oldName'])    : null;
        $password         = isset($_POST['oldPass'])    ? trim($_POST['oldPass'])    : null;
        $new_username     = isset($_POST['newName'])    ? trim($_POST['newName'])    : null;
        $new_password     = isset($_POST['newPass'])    ? trim($_POST['newPass'])    : null;
        $confirm_password = isset($_POST['newPassTwo']) ? trim($_POST['newPassTwo']) : null;

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

        $errors = array('oldNameErr' => '', 
                        'oldPassErr' => '', 
                        'newNameErr' => '' , 
                        'newPassErr' => '' , 
                        'confirmErr' => ''); // array containing errors

        if(!$has_username) { $errors['oldNameErr'] = 'Username cannot be empty'; } // old name req *
        if(!$has_password) { $errors['oldPassErr'] = 'Password cannot be empty'; } // old pass req *
        
        if($new_username_too_long) { $errors['newNameErr'] = 'Error! New username too long'; } // more than 30 chars not allowed *
        
        if($has_new_password)
        {
          if($new_password_too_short) { $errors['newPassErr'] = 'Error! New password must be at least 8 characters'; } // min 8 chars req *

          if(!$has_confirm_password) { $errors['confirmErr'] = 'Confirm cannot be empty'; } //  confirm pass req if new pass is existing *
          elseif($new_password !== $confirm_password) { $errors['confirmErr'] = 'New password and confirm password does not match'; } // new password and confirm must match *
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

        if(!check_str_empty($errors['oldNameErr'])) { echo $errors['oldNameErr'] . '<br>'; };
        if(!check_str_empty($errors['oldPassErr'])) { echo $errors['oldPassErr'] . '<br>'; };
        if(!check_str_empty($errors['newNameErr'])) { echo $errors['newNameErr'] . '<br>'; };
        if(!check_str_empty($errors['newPassErr'])) { echo $errors['newPassErr'] . '<br>'; };
        if(!check_str_empty($errors['confirmErr'])) { echo $errors['confirmErr'] . '<br>'; };
      }
    ?>
  </body>
</html>