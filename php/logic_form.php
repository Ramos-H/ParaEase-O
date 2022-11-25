<?php
  require_once 'constants.php';
  require_once 'utils.php';
  require_once 'database.php';
  
  $submit_value = isset($_POST['submit'])     ? trim($_POST['submit'])     : null;
  $name_first   = isset($_POST['name_first']) ? trim($_POST['name_first']) : null;
  $name_last    = isset($_POST['name_last'])  ? trim($_POST['name_last'])  : null;
  $email        = isset($_POST['email'])      ? trim($_POST['email'])      : null;
  $subject      = isset($_POST['subject'])    ? trim($_POST['subject'])    : null;
  $message      = isset($_POST['message'])    ? trim($_POST['message'])    : null;
  
  // We do the checks below AFTER getting the values so we aren't easily fooled by
  // the user that our forms have been filled even though they submitted just spaces as the input.
  // The trim() that happens before this step is very important.
  $has_submitted  = !check_str_empty($submit_value);
  $has_name_first = !check_str_empty($name_first);
  $has_name_last  = !check_str_empty($name_last);
  $has_email      = !check_str_empty($email);
  $has_subject    = !check_str_empty($subject);
  $has_message    = !check_str_empty($message);

  $too_long_name_first = $has_name_first ? (strlen($name_first) > MAX_LENGTH_FIELD)   : false;
  $too_long_name_last  = $has_name_last  ? (strlen($name_last)  > MAX_LENGTH_FIELD)   : false;
  $too_long_email      = $has_email      ? (strlen($email)      > MAX_LENGTH_FIELD)   : false;
  $too_long_subject    = $has_subject    ? (strlen($subject)    > MAX_LENGTH_FIELD)   : false;
  $too_long_message    = $has_message    ? (strlen($message)    > MAX_LENGTH_MESSAGE) : false;

  if(DEBUG_MODE)
  {
    echo sprintf('Has submitted: %s<br>',  boolToStr($has_submitted));
    echo sprintf('Submit value: %s<br>',  $has_submitted ? $submit_value : 'nothing');
    echo '<br>';

    echo sprintf('Has first name: %s<br>', boolToStr($has_name_first));
    echo sprintf('Has last name: %s<br>',  boolToStr($has_name_last));
    echo sprintf('Has email: %s<br>',      boolToStr($has_email));
    echo sprintf('Has subject: %s<br>',    boolToStr($has_subject));
    echo sprintf('Has message: %s<br>',    boolToStr($has_message));
    echo '<br>';

    echo sprintf('First name too long: %s<br>', boolToStr($too_long_name_first));
    echo sprintf('Last name too long: %s<br>',  boolToStr($too_long_name_last));
    echo sprintf('Email too long: %s<br>',      boolToStr($too_long_email));
    echo sprintf('Subject too long: %s<br>',    boolToStr($too_long_subject));
    echo sprintf('Message too long: %s<br>',    boolToStr($too_long_message));
    echo '<br>';
  }
  
  $response = '';

  if($has_submitted && $has_name_first && $has_name_last && $has_email && $has_subject && $has_message
      && !($too_long_name_first || $too_long_name_last || $too_long_email || $too_long_subject || $too_long_message))
  {
    if($submit_value === 'feedback')
    {
      if(!insert_new_feedback($name_first, $name_last, $email, $subject, $message))
      {
        $response = 'Something went wrong with inserting the new feedback';
      }
      else
      {
        $response = 'Your feedback has been submitted.';
      }
    }
    elseif(is_numeric($submit_value))
    {
      $package_id = intval($submit_value);

      if ($package_id < 1 || $package_id > PACKAGE_COUNT) 
      {
        $response = "The package ID submitted was out of the range of available packages.";
      }
      elseif(!insert_new_inquiry(intval($submit_value), $name_first, $name_last, $email, $subject, $message))
      {
        $response = 'Something went wrong with inserting the new inquiry';
      }
      else
      {
        $response = 'Your inquiry has been successfully submitted.';
        header('Location: index.php');
      }
    }
    else
    {
      $response = 'The submit value is invalid';
    }
  }

  // Get most popular package
  $most_popular_package = get_most_popular_package();
?>