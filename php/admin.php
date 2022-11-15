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
    td
    { 
      padding-left: 5px;
      padding-right: 5px;
    }
  </style>
</head>
<body>
  <?php

    $valid_passwords = array ("makten" => "ilovethis123");
    $valid_users = array_keys($valid_passwords);

    $user = $_SERVER['PHP_AUTH_USER'];
    $pass = $_SERVER['PHP_AUTH_PW'];

    $validation = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

    if (!$validation) {
      header('WWW-Authenticate: Basic realm="My Realm"');
      header('HTTP/1.0 401 Unauthorized');
      die ("<br><br>You are not allowed to enter this database.");
    }

    // If arrives here, is a valid user.
    echo "<p>Welcome $user.</p>";
    echo "<p>You are now in the database system.</p>";

  ?>

  <?php require_once 'database.php'; ?>
  
  <form action="admin.php" method="post">
    <h3>Feedback</h3>
    <table>
      <tr>
        <th> </th>
        <th>Status</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Message</th>
      </tr>

      <?php if(get_total_feedback_count() > 0): ?>
          <?php $feedbacks = get_all_feedbacks(); ?>
          <?php foreach($feedbacks as $feedback): ?>
            <tr>
              <td><input type="checkbox" name="resolve_<?php echo nl2br(htmlspecialchars($feedback['id']))?>"></td>
              <td style="text-align: center"><?php echo nl2br(htmlspecialchars($feedback['resolved'] ? 'RESOLVED' : 'UNRESOLVED')) ?></td>
              <td><?php echo nl2br(htmlspecialchars($feedback['name_first'])) ?></td>
              <td><?php echo nl2br(htmlspecialchars($feedback['name_last'])) ?></td>
              <td><?php echo nl2br(htmlspecialchars($feedback['email'])) ?></td>
              <td><?php echo nl2br(htmlspecialchars($feedback['subject'])) ?></td>
              <td><textarea readonly><?php echo nl2br(htmlspecialchars($feedback['message'])) ?></textarea></td>
            </tr>
          <?php endforeach; ?>
      <?php endif; ?>
    </table>
    <button type="submit" name="submit" value="feedbacks">Update feedbacks</button>

    <h3>Package Inquiries</h3>
    <table>
      <tr>
        <th> </th>
        <th>Status</th>
        <th>Package ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Message</th>
      </tr>

      <?php if(get_total_inquiry_count() > 0): ?>
          <?php $feedbacks = get_all_inquiries(); ?>
          <?php foreach($feedbacks as $feedback): ?>
            <tr>
              <td><input type="checkbox" name="resolve_<?php echo nl2br(htmlspecialchars($feedback['id']))?>"></td>
              <td style="text-align: center"><?php echo nl2br(htmlspecialchars($feedback['resolved'] ? 'RESOLVED' : 'UNRESOLVED')) ?></td>
              <td style="text-align: center"><?php echo nl2br(htmlspecialchars($feedback['package_id'])) ?></td>
              <td><?php echo nl2br(htmlspecialchars($feedback['name_first'])) ?></td>
              <td><?php echo nl2br(htmlspecialchars($feedback['name_last'])) ?></td>
              <td><?php echo nl2br(htmlspecialchars($feedback['email'])) ?></td>
              <td><?php echo nl2br(htmlspecialchars($feedback['subject'])) ?></td>
              <td><textarea readonly><?php echo nl2br(htmlspecialchars($feedback['message'])) ?></textarea></td>
            </tr>
          <?php endforeach; ?>
      <?php endif; ?>
    </table>
    <button type="submit" name="submit" value="inquiries">Update inquiries</button>
  </form>
</body>
</html>