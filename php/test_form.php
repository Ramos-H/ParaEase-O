<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Form Test</title>
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
  <?php require_once 'logic_form.php'; ?>

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
  
  <h3>The most popular package is package number <?php echo !check_str_empty($most_popular_package) ? $most_popular_package : 'Error' ?></h3>
</body>
</html>