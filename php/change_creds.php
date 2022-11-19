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
        $errors = errCheck(); // check if errors exist
        if(!empty($errors['oldNameErr'])) { phpAlert($errors['oldNameErr']); };
        if(!empty($errors['oldPassErr'])) { phpAlert($errors['oldPassErr']); };
        if(!empty($errors['newNameErr'])) { phpAlert($errors['newNameErr']); };
        if(!empty($errors['newPassErr'])) { phpAlert($errors['newPassErr']); };
        if(!empty($errors['confirmErr'])) { phpAlert($errors['confirmErr']); };
      }

      function errCheck() // validate user input. Throw errors into errors array
      { 
        //Define the array of error within this function 
        $errors = array('oldNameErr' => '', 'oldPassErr' => '', 'newNameErr' => '' , 'newPassErr' => '' , 'confirm' => ''); // array containing errors

        $username         = isset($_POST['oldName'])    ? trim($_POST['oldName'])    : null;
        $password         = isset($_POST['oldPass'])    ? trim($_POST['oldPass'])    : null;
        $new_username     = isset($_POST['newName'])    ? trim($_POST['newName'])    : null;
        $new_password     = isset($_POST['newPass'])    ? trim($_POST['newPass'])    : null;
        $confirm_password = isset($_POST['newPassTwo']) ? trim($_POST['newPassTwo']) : null;

        if(check_str_empty($username)) { $errors['oldNameErr'] = 'Username cannot be empty'; } // old name req *
        if(check_str_empty($password)) { $errors['oldPassErr'] = 'Password cannot be empty'; } // old pass req *
        
        if(strlen($new_username) > 30) { $errors['newNameErr'] = 'Error! New username too long'; } // more than 30 chars not allowed *
        
        if(!check_str_empty($new_password))
        {
          if(strlen($new_password) < 8) { $errors['newPassErr'] = 'Error! New password must be at least 8 characters'; } // min 8 chars req *

          if(check_str_empty($confirm_password)) { $errors['confirmErr'] = 'Confirm cannot be empty'; } //  confirm pass req if new pass is existing *
          elseif($new_password !== $confirm_password) { $errors['confirmErr'] = 'New password and confirm password does not match'; } // new password and confirm must match *
        }

        //Return the errors
        return $errors;
      }

      function phpAlert($msg) // In case errors exist
      {
        echo $msg;
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
      };
    ?>
  </body>
</html>