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

    $has_submitted = isset($_POST['submit']);

    $name_first = isset($_POST['name_first']) ? trim($_POST['name_first']) : null;
    $name_last  = isset($_POST['name_last'])  ? trim($_POST['name_last'])  : null;
    $email      = isset($_POST['email'])      ? trim($_POST['email'])      : null;
    $subject    = isset($_POST['subject'])    ? trim($_POST['subject'])    : null;
    $message    = isset($_POST['message'])    ? trim($_POST['message'])    : null;

    // We do the checks below AFTER getting the values so we aren't easily fooled by
    // the user that our forms have been filled even though they submitted just spaces as the input.
    // The trim() that happens before this step is very important.
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

    function print_err_text_on_error($concerned_property, $has_no_input, $input_too_long)
    {
      global $has_submitted;
      $invalid_input_template = '<span class="invalid-input">%s</span><br>';
      $no_input_message_template = 'Please enter your %s.';
      $long_input_message_template = 'The %s you entered is too long.';

      if($has_submitted)
      {
        if($has_no_input) { echo sprintf($invalid_input_template, sprintf($no_input_message_template, $concerned_property)); }
        elseif ($input_too_long) { echo sprintf($invalid_input_template, sprintf($long_input_message_template, $concerned_property)); }
      }
    }
  ?>

  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <label for="name_first">First Name</label><br>
    <input type="text" name="name_first" id="name_first"><br>
    <?php print_err_text_on_error('first name', !$has_name_first, $too_long_name_first) ?>
    
    <label for="name_last">Last Name</label><br>
    <input type="text" name="name_last" id="name_last"><br>
    <?php print_err_text_on_error('last name', !$has_name_last, $too_long_name_last) ?>
    
    <label for="email">Email</label><br>
    <input type="text" name="email" id="email"><br>
    <?php print_err_text_on_error('email', !$has_email, $too_long_email) ?>
    
    <label for="subject">Subject</label><br>
    <input type="text" name="subject" id="subject"><br>
    <?php print_err_text_on_error('subject', !$has_subject, $too_long_subject) ?>
    
    <label for="message">Message</label><br>
    <textarea name="message" id="message" cols="30" rows="10"></textarea><br>
    <?php print_err_text_on_error('message', !$has_message, $too_long_message) ?>

    <input type="submit" name="submit" value="Submit">
  </form>
</body>
</html>