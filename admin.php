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
      
      <div class="d-flex flex-row-reverse align-items-center justify-content-end ms-auto">
        <a class="btn btn-primary" href="php/logout.php">Log out</a>
        <a class="btn me-1 btn-secondary" href="php/test_change_creds.php">Change credentials</a>
      </div>
    </ul>
    
    <form method="POST" id="form_feedbacks" action="<?php echo sprintf('%s?tab=%s', htmlspecialchars($_SERVER['PHP_SELF']), 'feedbacks'); ?>"></form>
    <form method="POST" id="form_package_inquiries" action="<?php echo sprintf('%s?tab=%s', htmlspecialchars($_SERVER['PHP_SELF']), 'package_inquiries'); ?>"></form>

    <!-- Tab panes -->
    <div class="tab-content">
      <!-- feedbacks tab -->
      <div class="tab-pane <?php if(!$has_tab || $has_tab && ($tab === 'feedbacks')) { echo 'active'; } ?>" id="feedbacks" role="tabpanel" aria-labelledby="feedbacks-tab">
        <div class="container-fluid d-flex vh-100 flex-column py-3">
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
        <div class="container-fluid d-flex vh-100 flex-column py-3">
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