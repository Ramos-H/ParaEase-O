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
    
   ?>
  <p>Click <a href="logout.php">here</a> to log-out.</p>

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
              <td><input type="checkbox" name="resolve_<?php echo htmlspecialchars($feedback['id'])?>"></td>
              <td style="text-align: center"><?php echo htmlspecialchars($feedback['resolved'] ? 'RESOLVED' : 'UNRESOLVED') ?></td>
              <td><?php echo htmlspecialchars($feedback['name_first']) ?></td>
              <td><?php echo htmlspecialchars($feedback['name_last']) ?></td>
              <td><?php echo htmlspecialchars($feedback['email']) ?></td>
              <td><?php echo htmlspecialchars($feedback['subject']) ?></td>
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
              <td><input type="checkbox" name="resolve_<?php echo htmlspecialchars($feedback['id'])?>"></td>
              <td style="text-align: center"><?php echo htmlspecialchars($feedback['resolved'] ? 'RESOLVED' : 'UNRESOLVED') ?></td>
              <td style="text-align: center"><?php echo htmlspecialchars($feedback['package_id']) ?></td>
              <td><?php echo htmlspecialchars($feedback['name_first']) ?></td>
              <td><?php echo htmlspecialchars($feedback['name_last']) ?></td>
              <td><?php echo htmlspecialchars($feedback['email']) ?></td>
              <td><?php echo htmlspecialchars($feedback['subject']) ?></td>
              <td><textarea readonly><?php echo nl2br(htmlspecialchars($feedback['message'])) ?></textarea></td>
            </tr>
          <?php endforeach; ?>
      <?php endif; ?>
    </table>
    <button type="submit" name="submit" value="inquiries">Update inquiries</button>
  </form>
</body>
</html>