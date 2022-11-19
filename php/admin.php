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
  $table_value  = isset($_POST['table'])  ? strtolower(trim(htmlspecialchars($_POST['table']))) : null;
  $new_status   = isset($_POST['status']) ? strtolower(trim(htmlspecialchars($_POST['status']))) : null;
  $selected_ids = $_POST['statuses'] ?? null;

  $has_table_value  = !check_str_empty($table_value);
  $has_new_status   = !check_str_empty($new_status);
  $has_selected_ids = !empty($selected_ids);

  $valid_table_value = ($table_value === TABLE_FEEDBACKS || $table_value === TABLE_PACK_INQ);
  $valid_new_status  = str_starts_with($new_status, 'single_resolve') 
                    || str_starts_with($new_status, 'single_unresolve')
                    || str_starts_with($new_status, 'multiple_resolve')
                    || str_starts_with($new_status, 'multiple_unresolve');

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
    $resolve_info = explode('_', $new_status);
    $resolve_type = $resolve_info[0];
    $resolve_value = $resolve_info[1];
    if($resolve_value === 'resolve') { $resolve_value = 1; }
    elseif($resolve_value === 'unresolve') { $resolve_value = 0; }

    if($resolve_type === 'multiple')
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
      }
    }
    elseif($resolve_type === 'single')
    {
      $id = $resolve_info[2];
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
      echo update_resolve_status($table_value, $resolve_value, $ids);
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
      
      <?php if(get_total_table_count(TABLE_FEEDBACKS) > 0): ?>
        <?php $feedbacks = get_all_table_entries(TABLE_FEEDBACKS);?>
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
            <td><button type="submit" name="status" value="single_resolve_<?php echo htmlspecialchars($feedback['id'])?>">Mark as resolved</button></td>
            <td><button type="submit" name="status" value="single_unresolve_<?php echo htmlspecialchars($feedback['id'])?>">Mark as unresolved</button></td>
          </tr>
          <?php endforeach; ?>
      <?php endif; ?>
    </table>
    <input type="hidden" name="table" value="<?php echo TABLE_FEEDBACKS; ?>">
    <button type="submit" name="status" value="multiple_resolve">Mark as resolved</button>
    <button type="submit" name="status" value="multiple_unresolve">Mark as unresolved</button>
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

      <?php if(get_total_table_count(TABLE_PACK_INQ) > 0): ?>
          <?php $inquiries = get_all_table_entries(TABLE_PACK_INQ); ?>
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
              <td><button type="submit" name="status" value="single_resolve_<?php echo htmlspecialchars($inquiry['id'])?>">Mark as resolved</button></td>
            <td><button type="submit" name="status" value="single_unresolve_<?php echo htmlspecialchars($inquiry['id'])?>">Mark as unresolved</button></td>
            </tr>
          <?php endforeach; ?>
      <?php endif; ?>
    </table>
    <input type="hidden" name="table" value="<?php echo TABLE_PACK_INQ; ?>">
    <button type="submit" name="status" value="multiple_resolve">Mark as resolved</button>
    <button type="submit" name="status" value="multiple_unresolve">Mark as unresolved</button>
  </form>
</body>
</html>