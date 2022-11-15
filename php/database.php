<?php
  require_once 'constants.php';

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  $resolve_value = 0;

  if($conn->connect_error) { die('Connection failed' . $conn->connect_error); }
  if(DEBUG_MODE) { echo 'CONNECTED TO DATABASE!<br>'; }

  function insert_new_feedback($name_first, $name_last, $email, $subject, $message)
  {
    global $conn, $resolve_value;
    $sql = 'INSERT INTO `feedbacks` (`id`, `resolved`, `name_first`, `name_last`, `email`, `subject`, `message`, `post_time`) VALUES (NULL, ?, ?, ?, ?, ?, ?, current_timestamp())';
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }
    return $preppedStmt->bind_param('isssss', $resolve_value, $name_first, $name_last, $email, $subject, $message) ? $preppedStmt->execute() : false;
  }

  function insert_new_inquiry($package_id, $name_first, $name_last, $email, $subject, $message)
  {
    global $conn, $resolve_value;
    $sql = 'INSERT INTO `package_inquiries` (`id`, `resolved`, `package_id`, `name_first`, `name_last`, `email`, `subject`, `message`, `post_time`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, current_timestamp())';
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }
    return $preppedStmt->bind_param('iisssss', $resolve_value, $package_id, $name_first, $name_last, $email, $subject, $message) ? $preppedStmt->execute() : false;
  }

  function get_most_popular_package()
  {
    global $conn;
    $sql = 'SELECT `package_id` FROM `package_inquiries` GROUP BY `package_id` ORDER BY COUNT(`package_id`) DESC LIMIT 1';
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }
    return $preppedStmt->execute() ? $preppedStmt->fetch() : false;
  }
?>