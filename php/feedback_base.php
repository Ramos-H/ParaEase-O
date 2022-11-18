<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Page Title</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
  <script src='main.js'></script>
  <style>
    .invalid-input
    {
      color: #FF0000;
    }
  </style>
</head>
<body>
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
    $has_submitted  = !empty($submit_value);
    $has_name_first = !empty($name_first);
    $has_name_last  = !empty($name_last);
    $has_email      = !empty($email);
    $has_subject    = !empty($subject);
    $has_message    = !empty($message);

    $too_long_name_first = $has_name_first ? (strlen($name_first) > MAX_LENGTH_NAME_FIRST) : false;
    $too_long_name_last  = $has_name_last  ? (strlen($name_last)  > MAX_LENGTH_NAME_LAST)  : false;
    $too_long_email      = $has_email      ? (strlen($email)      > MAX_LENGTH_EMAIL)      : false;
    $too_long_subject    = $has_subject    ? (strlen($subject)    > MAX_LENGTH_SUBJECT)    : false;
    $too_long_message    = $has_message    ? (strlen($message)    > MAX_LENGTH_MESSAGE)    : false;

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

    if($has_submitted && $has_name_first && $has_name_last && $has_email && $has_subject && $has_message
        && !($too_long_name_first || $too_long_name_last || $too_long_email || $too_long_subject || $too_long_message))
    {
      if($submit_value === 'feedback')
      {
        if(!insert_new_feedback($name_first, $name_last, $email, $subject, $message))
        {
          echo 'Something went wrong with inserting the new feedback<br>';
        }
      }
      elseif(is_numeric($submit_value))
      {
        $package_id = intval($submit_value);

        if ($package_id < 1 || $package_id > PACKAGE_COUNT) {
          echo ("The package ID submitted was out of the range of available packages.<br>");
        }
        if(!insert_new_inquiry(intval($submit_value), $name_first, $name_last, $email, $subject, $message))
        {
          echo 'Something went wrong with inserting the new inquiry<br>';
        }
      }
      else
      {
        echo 'The submit value is invalid<br>';
      }
    }
  ?>

  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <label for="name_first">First Name</label><br>
    <input type="text" name="name_first" id="name_first"><br>
    <?php print_err_text_on_error('first name', $has_submitted, !$has_name_first, $too_long_name_first) ?>
    
    <label for="name_last">Last Name</label><br>
    <input type="text" name="name_last" id="name_last"><br>
    <?php print_err_text_on_error('last name', $has_submitted, !$has_name_last, $too_long_name_last) ?>
    
    <label for="email">Email</label><br>
    <input type="text" name="email" id="email"><br>
    <?php print_err_text_on_error('email', $has_submitted, !$has_email, $too_long_email) ?>
    
    <label for="subject">Subject</label><br>
    <input type="text" name="subject" id="subject"><br>
    <?php print_err_text_on_error('subject', $has_submitted, !$has_subject, $too_long_subject) ?>
    
    <label for="message">Message</label><br>
    <textarea name="message" id="message" cols="30" rows="10"></textarea><br>
    <?php print_err_text_on_error('message', $has_submitted, !$has_message, $too_long_message) ?>

    <button type="submit" name="submit" value="feedback">Send feedback!</button>

    <!-- Package values start from 1 instead of 0 because a value of 0 fails the empty() check, apparently -->
    <!-- TODO: Maybe separate data handling between feedback and inquiry to prevent cross-contamination between tables -->
    <button type="submit" name="submit" value="1">Package 1</button>
    <button type="submit" name="submit" value="2">Package 2</button>
    <button type="submit" name="submit" value="3">Package 3</button>
    <button type="submit" name="submit" value="4">Package 4</button>
  </form>

  <?php
    // Show most popular package
    $most_popular_package = get_most_popular_package();
  ?>
  
  <h3>The most popular package is package number <?php echo !empty($most_popular_package) ? $most_popular_package : 'Error' ?></h3>
</body>
</html>