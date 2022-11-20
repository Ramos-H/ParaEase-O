<?php
  require_once 'constants.php';
  require_once 'utils.php';

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  $default_resolve_value = 0;

  if($conn->connect_error) { die('Connection failed' . $conn->connect_error); }
  if(DEBUG_MODE) { echo 'CONNECTED TO DATABASE!<br>'; }

  function insert_new_feedback($name_first, $name_last, $email, $subject, $message)
  {
    global $conn, $default_resolve_value;
    $sql = 'INSERT INTO `feedbacks` (`id`, `resolved`, `name_first`, `name_last`, `email`, `subject`, `message`, `post_time`) VALUES (NULL, ?, ?, ?, ?, ?, ?, current_timestamp())';
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }
    return $preppedStmt->bind_param('isssss', $default_resolve_value, $name_first, $name_last, $email, $subject, $message) ? $preppedStmt->execute() : false;
  }

  function insert_new_inquiry($package_id, $name_first, $name_last, $email, $subject, $message)
  {
    global $conn, $default_resolve_value;
    $sql = 'INSERT INTO `package_inquiries` (`id`, `resolved`, `package_id`, `name_first`, `name_last`, `email`, `subject`, `message`, `post_time`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, current_timestamp())';
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }
    return $preppedStmt->bind_param('iisssss', $default_resolve_value, $package_id, $name_first, $name_last, $email, $subject, $message) ? $preppedStmt->execute() : false;
  }

  function get_most_popular_package()
  {
    global $conn;
    $sql = 'SELECT `package_id` FROM `package_inquiries` GROUP BY `package_id` ORDER BY COUNT(`package_id`) DESC LIMIT 1';
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }
    return $preppedStmt->execute() ? $preppedStmt->fetch() : false;
  }

  function get_total_table_count($table_name)
  {
    global $conn;
    $sql = "SELECT COUNT(*) FROM `$table_name`";
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }
    if(!$preppedStmt->execute()) { return false; } 
    $result = $preppedStmt->get_result();
    return !empty($result) ? $result->fetch_all()[0][0] : false;
  }

  function get_all_feedbacks()
  {
    global $conn;
    $sql = "SELECT * FROM `feedbacks` ORDER BY `resolved` ASC";
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }

    $feedbacks = array();
    if($preppedStmt->execute())
    {
      $result = $preppedStmt->get_result();
      while($row = $result->fetch_assoc())
      {
        $feedbacks[] = $row;
      }

      return $feedbacks;
    }

    return false;
  }

  function get_all_package_inquiries()
  {
    global $conn;
    $sql = "SELECT * FROM `package_inquiries` ORDER BY `resolved` ASC";
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }

    $feedbacks = array();
    if($preppedStmt->execute())
    {
      $result = $preppedStmt->get_result();
      while($row = $result->fetch_assoc())
      {
        $feedbacks[] = $row;
      }

      return $feedbacks;
    }

    return false;
  }

  function check_entry_existence($table_name, $id)
  {
    global $conn;
    $sql = "SELECT COUNT(1) FROM `$table_name` WHERE `id` = ? LIMIT 1";
    $preppedStmt = $conn->prepare($sql);

    if(!$preppedStmt) { return false; }
    if(!$preppedStmt->bind_param('i', $id)) { return false; }
    if(!$preppedStmt->execute()) { return false; }

    return ($preppedStmt->fetch() > 0);
  }

  function update_resolve_status($table_name, $new_value, $ids)
  {
    global $conn;
    $sql = "UPDATE `$table_name` SET `resolved` = ? WHERE `$table_name`.`id` = ?";
    $successful_updates = 0;

    foreach($ids as $entry => $id)
    {
      if(check_entry_existence($table_name, $id))
      {
        $preppedStmt = $conn->prepare($sql);
        if(!$preppedStmt) { return false; }
        if(!$preppedStmt->bind_param('ii', $new_value, $id)) { return false; }
        if($preppedStmt->execute()) { $successful_updates++; }
      }
    }

    return $successful_updates;
  }

  function create_default_admin()
  {
    reset_admins_increment_value();
    global $conn;
    $sql = 'INSERT INTO `admins` (`id`, `username`, `password`) VALUES (NULL, ?, ?)';
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }
    $default_username = 'admin';
    $default_password = 'password';
    $hashed_password = password_hash($default_password, PASSWORD_DEFAULT);
    return $preppedStmt->bind_param('ss', $default_username, $hashed_password) ? $preppedStmt->execute() : false;
  }

  function get_admins_with_username($username)
  {
    global $conn;
    $sql = 'SELECT `username`, `password` FROM `admins` WHERE `username` = ?';
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }

    if(!$preppedStmt->bind_param('s', $username)) { return false; }

    $feedbacks = array();
    if($preppedStmt->execute())
    {
      $result = $preppedStmt->get_result();
      while($row = $result->fetch_assoc())
      {
        $admins[] = $row;
      }

      return $admins ?? array();
    }

    return false;
  }

  function verify_credentials($username, $password)
  {
    if(get_total_table_count('admins') < 1) { create_default_admin(); }

    $admins = get_admins_with_username($username);

    if(!empty($admins))
    {
      foreach ($admins as $admin)
      {
        if(password_verify($password, $admin['password'])) { return true; }
      }
    }

    return false;
  }

  function update_credentials($new_username, $new_password)
  {
    global $conn;
    $sql = 'UPDATE `admins` SET ';
    
    // Exit conditions
    if(!isset($new_username) && !isset($new_password)) { return false; }
    if(check_str_empty($new_username) && check_str_empty($new_password)) { return false; }
    
    $has_new_username = !check_str_empty($new_username);
    $has_new_password = !check_str_empty($new_password);

    // Add username to query if it's given
    if(isset($new_username)) 
    {
      if($has_new_username) { $sql .= '`username` = ?'; }
    }
    
    // Add comma to separate the username and password queries if both username and password are present
    if(isset($new_username) && isset($new_password))
    {
      if($has_new_username && $has_new_password) { $sql .= ', '; }
    }
    
    // Add password to query if it's given
    if(isset($new_password)) 
    {
      if($has_new_password) { $sql .= '`password` = ?'; }
    }
    
    // Last part of SQL statement
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }

    $param_bind_success = false;
    if($has_new_username && !$has_new_password)
    {
      $param_bind_success = $preppedStmt->bind_param('s', $new_username);
    }
    elseif (!$has_new_username && $has_new_password) 
    {
      $param_bind_success = $preppedStmt->bind_param('s', $new_password);
    }
    elseif ($has_new_username && $has_new_password) 
    {
      $param_bind_success = $preppedStmt->bind_param('ss', $new_username, $new_password);
    }

    if(!$param_bind_success) { return false; }
    return $preppedStmt->execute();
  }

  function reset_admins_increment_value()
  {
    global $conn;
    $sql = 'ALTER TABLE admins auto_increment = 1';
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }
    return $preppedStmt->execute();
  }
?>