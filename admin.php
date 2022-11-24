<!doctype html>
<html lang="en">
  
  <head>
    <title>Admin Page Mockup 2</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
    <script src="scripts/admin.js"></script>
  </head>
  
  <body>
    <header>
      
      </header>
      <main>
        <?php
      require_once 'php/logic_admin.php';
      require_once 'php/logic_change_creds.php';
      require_once 'php/utils.php';
      $tab = isset($_GET['tab']) ? trim($_GET['tab']) : null;
      $has_tab = !check_str_empty($tab);
      ?>
    
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link <?php if(!$has_tab || $has_tab && ($tab === 'feedbacks')) { echo 'active'; } ?>" id="feedbacks-tab" data-bs-toggle="tab" data-bs-target="#feedbacks" type="button" role="tab" aria-controls="feedbacks" aria-selected="true">Feedbacks</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?php if($has_tab && ($tab === 'package_inquiries')) { echo 'active'; } ?>" id="package_inquiries-tab" data-bs-toggle="tab" data-bs-target="#package_inquiries" type="button" role="tab" aria-controls="package_inquiries" aria-selected="false">Package Inquiries</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?php if($has_tab && ($tab === 'change_credentials')) { echo 'active'; } ?>" id="change_credentials-tab" data-bs-toggle="tab" data-bs-target="#change_credentials" type="button" role="tab" aria-controls="change_credentials" aria-selected="false">Change Credentials</button>
      </li>
      
      <div class="d-flex flex-row-reverse align-items-center justify-content-end ms-auto">
        <a class="btn btn-primary" href="php/logout.php">Log out</a>
      </div>
    </ul>
    
    <form method="POST" id="form_feedbacks" action="<?php echo sprintf('%s?tab=%s', htmlspecialchars($_SERVER['PHP_SELF']), 'feedbacks'); ?>"></form>
    <form method="POST" id="form_package_inquiries" action="<?php echo sprintf('%s?tab=%s', htmlspecialchars($_SERVER['PHP_SELF']), 'package_inquiries'); ?>"></form>
    <form method="POST" id="form_change_credentials" action="<?php echo sprintf('%s?tab=%s', htmlspecialchars($_SERVER['PHP_SELF']), 'change_credentials'); ?>"></form>

    <!-- Tab panes -->
    <div class="tab-content">
      <!-- feedbacks tab -->
      <div class="tab-pane <?php if(!$has_tab || $has_tab && ($tab === 'feedbacks')) { echo 'active'; } ?>" id="feedbacks" role="tabpanel" aria-labelledby="feedbacks-tab">
        <div class="container d-flex vh-100 flex-column py-3">
            <!-- Table indicator -->
            <input type="hidden" form="form_feedbacks" name="table" value="feedbacks">
            <!-- Buttons -->
            <div class="row flex-shrink-1 pb-2">
              <div class="col">
                <button type="submit" form="form_feedbacks" name="status" value="multiple_resolve" class="btn btn-primary">Mark as resolved</button>
                <button type="submit" form="form_feedbacks" name="status" value="multiple_unresolve" class="btn btn-secondary">Mark as unresolved</button>
              </div>
            </div>
    
            <!-- Entry list -->
            <div class="row flex-grow-1 overflow-auto">
              <div class="col">
                <?php if(get_total_table_count(TABLE_FEEDBACKS) > 0): ?>
                  <?php $feedbacks = get_all_feedbacks(); ?>
                  <?php foreach($feedbacks as $feedback): ?>
                    <!-- Entry start -->
                    <div class="card mb-2 overflow-hidden" onclick="show_entry_full(this, 'feedbacks')">
                      <div class="row px-2 d-flex align-items-center">
                        <!-- Checkbox -->
                        <div class="col-auto">
                          <input type="checkbox" form="form_feedbacks" class="selector" name="statuses[<?php echo htmlspecialchars($feedback['id'])?>]" onclick="stop_checkbox_bubble(event)">
                        </div>
                        <div class="col">
                          <div class="row">
                            <!-- Name, Email, Subject, Content -->
                            <div class="col">
                              <?php if(!$feedback['resolved']) { echo '<strong>'; } ?>
                                <span class="name_first"><?php echo htmlspecialchars($feedback['name_first'])?> </span>
                                <span class="name_last"><?php echo htmlspecialchars($feedback['name_last'])?> </span>
                                <span class="email">(<?php echo htmlspecialchars($feedback['email'])?>) </span>
                                <span class="subject"><em><?php echo htmlspecialchars($feedback['subject'])?> </em></span>
                              <?php if(!$feedback['resolved']) { echo '</strong>'; } ?>
                              <span class=" message"><?php echo htmlspecialchars($feedback['message'])?> </span>
                            </div>
                            <!-- Time -->
                            <div class="col-auto">
                              <span class="time"><?php echo htmlspecialchars($feedback['post_time'])?></span>
                            </div>
                          </div>
                        </div>
                        <!-- Status -->
                        <input type="hidden" form="form_feedbacks" class="current_status" value="<?php echo htmlspecialchars($feedback['resolved']) ?>">
                      </div>
                    </div>
                    <!-- Entry end -->
                  <?php endforeach; ?>
                <?php else: ?>
                  Nothing to see here!
                <?php endif; ?>
              </div>
            </div>
        </div>
      </div>
      
      <!-- package inquiries tab -->
      <div class="tab-pane <?php if($has_tab && ($tab === 'package_inquiries')) { echo 'active'; } ?>" id="package_inquiries" role="tabpanel" aria-labelledby="package_inquiries-tab">
        <div class="container d-flex vh-100 flex-column py-3">
            <!-- Table indicator -->
            <input type="hidden" form="form_package_inquiries" name="table" value="package_inquiries">
            <!-- Buttons -->
            <div class="row flex-shrink-1 pb-2">
              <div class="col">
                <button type="submit" form="form_package_inquiries" name="status" value="multiple_resolve" class="btn btn-primary">Mark as resolved</button>
                <button type="submit" form="form_package_inquiries" name="status" value="multiple_unresolve" class="btn btn-secondary">Mark as unresolved</button>
              </div>
            </div>
    
            <!-- Entry list -->
            <div class="row flex-grow-1 overflow-auto">
              <div class="col">
                <?php if(get_total_table_count(TABLE_PACK_INQ) > 0): ?>
                  <?php $inquiries = get_all_package_inquiries(); ?>
                  <?php foreach($inquiries as $inquiry): ?>
                    <!-- Entry start -->
                    <div class="card mb-2 overflow-hidden" onclick="show_entry_full(this,'package_inquiries')">
                      <div class="row px-2 d-flex align-items-center">
                        <!-- Checkbox -->
                        <div class="col-auto">
                          <input type="checkbox" form="form_package_inquiries" class="selector" name="statuses[<?php echo htmlspecialchars($inquiry['id'])?>]" onclick="stop_checkbox_bubble(event)">
                        </div>
                        <div class="col">
                          <div class="row">
                            <!-- Name, Email, Subject, Content -->
                            <div class="col">
                              <?php if(!$inquiry['resolved']) { echo '<strong>'; } ?>
                                <span class="name_first"><?php echo htmlspecialchars($inquiry['name_first'])?> </span>
                                <span class="name_last"><?php echo htmlspecialchars($inquiry['name_last'])?> </span>
                                <span class="email">(<?php echo htmlspecialchars($inquiry['email'])?>) </span>
                                <span class="subject"><em><?php echo htmlspecialchars($inquiry['subject'])?> </em></span>
                              <?php if(!$inquiry['resolved']) { echo '</strong>'; } ?>
                              <span class=" message"><?php echo htmlspecialchars($inquiry['message'])?> </span>
                            </div>
                            <!-- Time -->
                            <div class="col-auto">
                              <span class="time"><?php echo htmlspecialchars($inquiry['post_time'])?></span>
                            </div>
                          </div>
                        </div>
                        <!-- Status -->
                        <input type="hidden" form="form_package_inquiries" class="current_status" value="<?php echo htmlspecialchars($inquiry['resolved']) ?>">
                        <input type="hidden" form="form_package_inquiries" class="package_id" value="<?php echo htmlspecialchars($inquiry['package_id']) ?>">
                      </div>
                    </div>
                    <!-- Entry end -->
                  <?php endforeach; ?>
                <?php else: ?>
                  Nothing to see here!
                <?php endif; ?>
              </div>
            </div>
        </div>
      </div>

      <!-- Change credentials tab -->
      <div class="tab-pane <?php if($has_tab && ($tab === 'change_credentials')) { echo 'active'; } ?>" id="change_credentials" role="tabpanel" aria-labelledby="change_credentials-tab">
        <div class="container mt-2">
          <h3>Current Credentials</h3>
          <p>For security purposes, you must enter the current credentials. </p>
          <!-- Username -->
          <div class="form-floating col-md-5 mb-3">
            <input type="text" class="form-control <?php if(isset($_POST['submit']) && !$has_username) { echo 'is-invalid'; } ?>" form="form_change_credentials" name="username" id="username" placeholder="Username">
            <label for="username">Username</label>
            <div class="invalid-feedback"><?php if(!check_str_empty($errors['username'])) { echo htmlspecialchars($errors['username']); } ?></div>
          </div>
          <!-- Password -->
          <div class="form-floating col-md-5 mb-3">
            <input type="password" class="form-control <?php if(isset($_POST['submit']) && !$has_password) { echo 'is-invalid'; } ?>" form="form_change_credentials" name="password" id="password" placeholder="Password">
            <label for="password">Password</label>
            <div class="invalid-feedback"><?php if(!check_str_empty($errors['password'])) { echo htmlspecialchars($errors['password']); } ?></div>
          </div>
          
          <h3>New Credentials</h3>
          <p>For credentials you don't want to change, enter their current values again.</p>
          <!-- New Username -->
          <div class="form-floating col-md-5 mb-3">
            <input type="text" class="form-control <?php if(isset($_POST['submit']) && !$has_new_username || $new_username_too_long) { echo 'is-invalid'; } ?>" form="form_change_credentials" name="new_username" id="new_username" placeholder="New Username">
            <label for="new_username">New Username</label>
            <div class="invalid-feedback"><?php if(!check_str_empty($errors['new_username'])) { echo htmlspecialchars($errors['new_username']); } ?></div>
          </div>
          <!-- New Password -->
          <div class="form-floating col-md-5 mb-3">
            <input type="password" class="form-control <?php if(isset($_POST['submit']) && !$has_new_password || $new_password_too_short) { echo 'is-invalid'; } ?>" form="form_change_credentials" name="new_password" id="new_password" placeholder="New Password">
            <label for="new_password">New Password</label>
            <div class="invalid-feedback"><?php if(!check_str_empty($errors['new_password'])) { echo htmlspecialchars($errors['new_password']); } ?></div>
          </div>
          <!-- Confirm Password -->
          <div class="form-floating col-md-5 mb-3">
            <?php
            $invalid_confirm_password = false;
            if(isset($_POST['submit']) && $has_new_password)
            {
              $invalid_confirm_password = ($has_confirm_password) ? !$confirm_password_matches : true;
            }
            ?>
            <input type="password" class="form-control <?php if($invalid_confirm_password) { echo 'is-invalid'; } ?>" form="form_change_credentials" name="confirm_password" id="confirm_password" placeholder="Confirm New Password">
            <label for="confirm_password">Confirm New Password</label>
            <div class="invalid-feedback"><?php if(!check_str_empty($errors['confirm_password'])) { echo htmlspecialchars($errors['confirm_password']); } ?></div>
          </div>
          <!-- Submit -->
          <button type="submit" class="btn btn-primary" form="form_change_credentials" name="submit" value="change_creds">Change</button>
        </div>
      </div>
    </div>

    <!-- Modal Start -->
    <div class="modal fade" id="modal_entry" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">About this message</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="container-fluid">
              
              <div class="row">
                <span>
                  <small class="text-muted">
                    <strong>STATUS: </strong><span class="status">UNRESOLVED</span>
                  </small>
                </span>

                <h3 class="subject">Subject</h3>

                <p>
                  <strong>From: </strong>
                  <span class="name_first">First Name </span>
                  <span class="name_last">Last Name </span>
                  <small class="text-muted email">(Email)</small>
                  <span class="package_container" style="display: none;">
                    <strong>For: </strong><span class="package">PACKAGE (A/B/C)</span>
                  </span>
                </p>

                <p class="message">Message here</p>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" from="form_feedbacks" name="status" class="btn resolve btn-primary">Mark as resolved</button>
          <button type="submit" from="form_feedbacks" name="status" class="btn unresolve btn-secondary">Mark as unresolved</button>
          <input type="hidden" form="form_feedbacks" name="table" class="table_name" value="feedbacks">
        </div>
      </div>
    </div>
    <!-- Modal End -->
  </div>
  </main>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>