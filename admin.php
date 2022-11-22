<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Admin Dashboard Test</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="stylesheet" href="styles/admin.css">
  <script defer src="../scripts/admin.js"></script>
</head>
<body>
  <?php require_once 'php/logic_admin.php'; ?>
  <div class="header">
    <span>ADMIN DASHBOARD</span>
    <button href="php/logout.php" class="logout-btn">Logout</button>
  </div>

  <main class="admin-container">
    <div class="left-sidebar">
      <span class="colored" id="feedback-menu">FEEDBACK</span>
      <span class="uncolored" id="packages-menu">PACKAGES</span>
    </div>

    <div class="right-sidebar">
      <div class="content-container feedback-container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
          <h3>Feedback</h3>
            <?php if(get_total_table_count(TABLE_FEEDBACKS) > 0): ?>
              <?php $feedbacks = get_all_feedbacks(); ?>
              <?php foreach($feedbacks as $feedback): ?>
                  <div class="feedback-wrapper">
                    <input type="checkbox" name="statuses[<?php echo htmlspecialchars($feedback['id'])?>]" id="status" />
                    
                    <div class="row-0">
                      <p class="<?php echo htmlspecialchars($feedback['resolved'] ? 'green' : 'red') ?>"><?php echo htmlspecialchars($feedback['resolved'] ? 'RESOLVED' : 'UNRESOLVED') ?></p>
                      <p><?php echo htmlspecialchars($feedback['post_time']) ?></p>
                    </div>
                    <div class="row-1">
                      <p><strong>First Name: </strong><?php echo htmlspecialchars($feedback['name_first']) ?></p>
                      <p><strong>Last Name: </strong><?php echo htmlspecialchars($feedback['name_last']) ?></p>
                      <p><strong>Email: </strong><?php echo htmlspecialchars($feedback['email']) ?></p>
                    </div>
                    <div class="row-2">
                      <p><strong>Subject: </strong><?php echo htmlspecialchars($feedback['subject']) ?></p>
                    </div>
                    <div class="row-3">
                      <strong>Message: </strong>  
                      <p><?php echo nl2br(htmlspecialchars($feedback['message'])) ?></p>
                    </div>
                    <div class="row-4">
                      <button type="submit" name="status" value="single_resolve_<?php echo htmlspecialchars($feedback['id'])?>" class="btn-resolve resolution-btn">Mark as resolved</button>
                      <button type="submit" name="status" value="single_unresolve_<?php echo htmlspecialchars($feedback['id'])?>" class="btn-unresolve resolution-btn">Mark as unresolved</button>
                    </div>
                  </div>
                <?php endforeach; ?>
            <?php endif; ?>

          <input type="hidden" name="table" value="<?php echo TABLE_FEEDBACKS; ?>" />

          <button type="submit" name="status" value="multiple_resolve" class="btn-resolve resolution-btn">Mark as resolved</button>
          <button type="submit" name="status" value="multiple_unresolve" class="btn-unresolve resolution-btn">Mark as unresolved</button>
        </form>
      </div>
    
      <div class="content-container packages-container none">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
          <h3>Package Inquiries</h3>

            <?php if(get_total_table_count(TABLE_PACK_INQ) > 0): ?>
                <?php $inquiries = get_all_package_inquiries(); ?>
                <?php foreach($inquiries as $inquiry): ?>
                  <input type="checkbox" name="statuses[<?php echo htmlspecialchars($inquiry['id'])?>]">
                    <?php echo htmlspecialchars($inquiry['resolved'] ? 'RESOLVED' : 'UNRESOLVED') ?>
                    <?php echo htmlspecialchars($inquiry['package_id']) ?>
                    <?php echo htmlspecialchars($inquiry['name_first']) ?>
                    <?php echo htmlspecialchars($inquiry['name_last']) ?>
                    <?php echo htmlspecialchars($inquiry['email']) ?>
                    <?php echo htmlspecialchars($inquiry['subject']) ?>
                    <p><?php echo nl2br(htmlspecialchars($inquiry['message'])) ?></p>
                    <?php echo htmlspecialchars($inquiry['post_time']) ?>
                    <button type="submit" name="status" value="single_resolve_<?php echo htmlspecialchars($inquiry['id'])?>">Mark as resolved</button>
                  <button type="submit" name="status" value="single_unresolve_<?php echo htmlspecialchars($inquiry['id'])?>">Mark as unresolved</button>
                  
                <?php endforeach; ?>
            <?php endif; ?>
      
          <input type="hidden" name="table" value="<?php echo TABLE_PACK_INQ; ?>">
          <button type="submit" name="status" value="multiple_resolve">Mark as resolved</button>
          <button type="submit" name="status" value="multiple_unresolve">Mark as unresolved</button>
        </form>
      </div>
    </div>
    
  </main>
</body>
</html>