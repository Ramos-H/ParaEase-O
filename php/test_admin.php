<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Admin Dashboard Test</title>
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
  <p>Click <a href="logout.php">here</a> to log-out.</p>
  <?php require_once 'logic_admin.php'; ?>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
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
  
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
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