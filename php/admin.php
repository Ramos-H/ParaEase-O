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
    textarea
    {
      background: rgba(0, 0, 0, 0);
      border: none;
      outline: 0;
      cursor: default;
      resize: none;
    }
  </style>
</head>
<body>
  <?php
    session_start();
    if(!isset($_SESSION['logged_in'])) {
      header("Location: login.php");
    }
   ?>
  <p>Click <a href="logout.php">here</a> to log-out.</p>

  <?php require_once 'database.php'; ?>
  <?php require_once 'constants.php'; ?>
  <?php require_once 'utils.php'; ?>
  
  <?php
  $table_value  = isset($_POST['table'])  ? trim(htmlspecialchars($_POST['table'])) : null;
  $new_status   = isset($_POST['status']) ? trim(htmlspecialchars($_POST['status'])) : null;
  $selected_ids = $_POST['statuses'] ?? null;

  $has_table_value  = !empty($table_value);
  $has_new_status   = !empty($new_status);
  $has_selected_ids = !empty($selected_ids);

  $valid_table_value = ($table_value === 'feedbacks' || $table_value === 'package_inquiries');
  $valid_new_status  = ($new_status  === '2' || $new_status  === '1');

  if(DEBUG_MODE)
  {
    echo sprintf('Table value: %s<br>', $has_table_value ? $table_value : 'Nothing');
    echo sprintf('New status: %s<br>' , $has_new_status  ? ($new_status == '2' ? 'resolved' : 'unresolved')  : 'Nothing');

    echo sprintf('Has table value: %s<br>', boolToStr($has_table_value));
    echo sprintf('Has new status: %s<br>', boolToStr($has_new_status));
    echo sprintf('Has selected IDs: %s<br>', boolToStr($has_selected_ids));

    echo sprintf('Has valid table value: %s<br>', boolToStr($valid_table_value));
    echo sprintf('Has valid new status: %s<br>', boolToStr($valid_new_status));
    echo '<br>';
  }

  if($has_table_value && $has_new_status && $valid_table_value && $valid_new_status)
  {
    if(!$has_selected_ids)
    {
      echo 'No entries were selected so nothing was changed.';
    }
    else
    {
      $ids = array();
      foreach ($selected_ids as $id => $values)
      {
        if(is_string($id) || is_double($id))
        {
          if(is_numeric($id)) { $ids[] = intval($id); }
        }
        elseif(is_int($id))
        {
          $ids[] = $id;
        }
      }

      if(!empty($ids)) 
      { 
        if(DEBUG_MODE) { print_r($ids); }
        echo update_resolve_status($table_value, $new_status - 1, $ids);
      }
    }
  }

  ?>
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
        <th>Post Time</th>
      </tr>
      
      <?php if(get_total_feedback_count() > 0): ?>
        <?php $feedbacks = get_all_feedbacks(); ?>
        <?php foreach($feedbacks as $feedback): ?>
          <tr>
            <td><input type="checkbox" name="statuses[<?php echo htmlspecialchars($feedback['id'])?>]"></td>
            <td style="text-align: center"><?php echo htmlspecialchars($feedback['resolved'] ? 'RESOLVED' : 'UNRESOLVED') ?></td>
            <td><?php echo htmlspecialchars($feedback['name_first']) ?></td>
            <td><?php echo htmlspecialchars($feedback['name_last']) ?></td>
            <td><?php echo htmlspecialchars($feedback['email']) ?></td>
            <td><?php echo htmlspecialchars($feedback['subject']) ?></td>
            <td><textarea readonly><?php echo nl2br(htmlspecialchars($feedback['message'])) ?></textarea></td>
            <td><?php echo htmlspecialchars($feedback['post_time']) ?></td>
          </tr>
          <?php endforeach; ?>
      <?php endif; ?>
    </table>
    <input type="hidden" name="table" value="feedbacks">
    <button type="submit" name="status" value="2">Mark as resolved</button>
    <button type="submit" name="status" value="1">Mark as unresolved</button>
  </form>
  
  <form action="admin.php" method="post">
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
        <th>Post Time</th>
      </tr>

      <?php if(get_total_inquiry_count() > 0): ?>
          <?php $inquiries = get_all_inquiries(); ?>
          <?php foreach($inquiries as $inquiry): ?>
            <tr>
              <td><input type="checkbox" name="statuses[<?php echo htmlspecialchars($inquiry['id'])?>]"></td>
              <td style="text-align: center"><?php echo htmlspecialchars($inquiry['resolved'] ? 'RESOLVED' : 'UNRESOLVED') ?></td>
              <td style="text-align: center"><?php echo htmlspecialchars($inquiry['package_id']) ?></td>
              <td><?php echo htmlspecialchars($inquiry['name_first']) ?></td>
              <td><?php echo htmlspecialchars($inquiry['name_last']) ?></td>
              <td><?php echo htmlspecialchars($inquiry['email']) ?></td>
              <td><?php echo htmlspecialchars($inquiry['subject']) ?></td>
              <td><textarea readonly><?php echo nl2br(htmlspecialchars($inquiry['message'])) ?></textarea></td>
              <td><?php echo htmlspecialchars($inquiry['post_time']) ?></td>
            </tr>
          <?php endforeach; ?>
      <?php endif; ?>
    </table>
    <input type="hidden" name="table" value="package_inquiries">
    <button type="submit" name="status" value="2">Mark as resolved</button>
    <button type="submit" name="status" value="1">Mark as unresolved</button>
  </form>
</body>
</html>