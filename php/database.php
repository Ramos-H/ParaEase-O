<?php
  require_once 'constants.php';

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
    return $preppedStmt->execute() ? $preppedStmt->fetch() : false;
  }

  function get_all_table_entries($table_name)
  {
    global $conn;
    $sql = "SELECT * FROM `$table_name`";
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
    $sql = "SELECT COUNT(1) FROM `$table_name` WHERE id = ? LIMIT 1";
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
?>