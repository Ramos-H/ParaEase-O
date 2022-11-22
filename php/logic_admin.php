<?php
  require_once 'database.php';
  require_once 'constants.php';
  require_once 'utils.php';

  session_start();
  if(!isset($_SESSION['logged_in'])) { header("Location: php/test_login.php"); }

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
      update_resolve_status($table_value, $resolve_value, $ids);
    }
  }
?>