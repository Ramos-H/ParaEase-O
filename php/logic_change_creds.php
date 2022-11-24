<?php
  require_once 'utils.php';
  require_once 'database.php';
  require_once 'constants.php';

  session_start();
  // if(!isset($_SESSION['logged_in'])) { header("Location: test_login.php"); }

  $errors = array('username' => '', 
                    'password' => '', 
                    'new_username' => '' , 
                    'new_password' => '' , 
                    'confirm_password' => ''); // array containing errors

  $change_cred_feedback = array('success' => '', 'failure' => '');

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
    $confirm_password_matches = ($has_new_password && $has_confirm_password) ? ($new_password === $confirm_password) : false;

    if(DEBUG_MODE)
    {
      echo sprintf('Has username: %s<br>',         boolToStr($has_username));
      echo sprintf('Has password: %s<br>',         boolToStr($has_password));
      echo sprintf('Has new username: %s<br>',     boolToStr($has_new_username));
      echo sprintf('Has new password: %s<br>',     boolToStr($has_new_password));
      echo sprintf('Has confirm password: %s<br>', boolToStr($has_confirm_password));
      echo '<br>';
      echo sprintf('New username too long: %s<br>', boolToStr($new_username_too_long));
      echo sprintf('New password too short: %s<br>', boolToStr($new_password_too_short));
      echo sprintf('Confirm password matches: %s<br>', boolToStr($confirm_password_matches));
      echo '<br>';
    }

    if(!$has_username) { $errors['username'] = 'Username cannot be empty'; } // old name req *
    if(!$has_password) { $errors['password'] = 'Password cannot be empty'; } // old pass req *

    if(!$has_new_username) { $errors['new_username'] = 'New Username cannot be empty'; } // new username req *
    else
    {
      if($new_username_too_long) // more than 30 chars not allowed *
      {
        $text = sprintf('New username must not be longer than %d characters. Please delete %d character/s to continue.', MAX_LENGTH_FIELD, (strlen($new_username) - MAX_LENGTH_FIELD));
        $errors['new_username'] = $text; 
      }
    }

    if(!$has_new_password) { $errors['new_password'] = 'New Password cannot be empty'; } // new password req *
    else
    {
      if($new_password_too_short) // min 8 chars req *
      {
        $text = sprintf('New password must be at least %d characters. Please enter %d more character/s to continue.', MIN_LENGTH_PASSWORD, (MIN_LENGTH_PASSWORD - strlen($new_password)));
        $errors['new_password'] = $text;
      } 
  
      if(!$has_confirm_password) { $errors['confirm_password'] = 'Please enter your new password again.'; } //  confirm pass req if new pass is existing *
      elseif($new_password !== $confirm_password) 
      {
        if(!$confirm_password_matches) { $errors['confirm_password'] = 'New password and confirm password does not match.'; } // new password and confirm must match *
      } 
    }

    if($has_username && $has_password)
    {
      if(!verify_credentials($username, $password))
      { $change_cred_feedback = 'Invalid current username and password.'; }
      else
      {
        if($has_new_username && !$new_username_too_long && $has_new_password && $has_confirm_password && $confirm_password_matches)
        {
          if (update_credentials($new_username, $new_password)) 
            { $change_cred_feedback['success'] = 'Your credentials have been changed.'; }
          else
            { $change_cred_feedback['failure'] = 'Your credentials have been changed.'; }
        }
      }
    }

    if(DEBUG_MODE && !check_str_empty($errors['username']))         { echo sprintf('%s<br>', $errors['username']); }
    if(DEBUG_MODE && !check_str_empty($errors['password']))         { echo sprintf('%s<br>', $errors['password']); }
    if(DEBUG_MODE && !check_str_empty($errors['new_username']))     { echo sprintf('%s<br>', $errors['new_username']); }
    if(DEBUG_MODE && !check_str_empty($errors['new_password']))     { echo sprintf('%s<br>', $errors['new_password']); }
    if(DEBUG_MODE && !check_str_empty($errors['confirm_password'])) { echo sprintf('%s<br>', $errors['confirm_password']); }
  }
?>