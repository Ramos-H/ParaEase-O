<?php
  require_once 'constants.php';

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if($conn->connect_error) { die('Connection failed' . $conn->connect_error); }
  if(DEBUG_MODE) { echo 'CONNECTED TO DATABASE!<br>'; }

  function insert_new_feedback($name_first, $name_last, $email, $subject, $message)
  {
    global $conn;
    $sql = 'INSERT INTO `feedbacks` (`id`, `name_first`, `name_last`, `email`, `subject`, `message`, `post_time`) VALUES (NULL, ?, ?, ?, ?, ?, current_timestamp())';
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }
    return $preppedStmt->bind_param('sssss', $name_first, $name_last, $email, $subject, $message) ? $preppedStmt->execute() : false;
  }

  function insert_new_inquiry($package_id, $name_first, $name_last, $email, $subject, $message)
  {
    global $conn;
    $sql = 'INSERT INTO `package_inquiries` (`id`, `package_id`, `name_first`, `name_last`, `email`, `subject`, `message`, `post_time`) VALUES (NULL, ?, ?, ?, ?, ?, ?, current_timestamp())';
    $preppedStmt = $conn->prepare($sql);
    if(!$preppedStmt) { return false; }
    return $preppedStmt->bind_param('isssss', $package_id, $name_first, $name_last, $email, $subject, $message) ? $preppedStmt->execute() : false;
  }
?>