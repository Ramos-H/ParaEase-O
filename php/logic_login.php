<?php
  require_once 'utils.php';
  require_once 'constants.php';
  require_once 'database.php';

  session_start();
  
  if(isset($_POST['submit']))
  {
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    $has_username = !check_str_empty($username);
    $has_password = !check_str_empty($password);

    if(!$has_username && !$has_password)
    {
      $errors[] = '<center>Please enter your username and password.</center>';
    }
    else if(!$has_username || !$has_password || ($username !== 'valid_username' && $password !== 'valid_password'))
    {
      $errors[] = '<center>Invalid Credentials.</center>';
    }
    else
    {
      $_SESSION['logged_in'] = true;
      header('Location: test_admin.php');
    }
  }
?>