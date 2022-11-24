<?php
function boolToStr($value)
{
  return $value ? 'true' : 'false';
}

function print_err_text_on_error($concerned_property, $has_submitted, $has_no_input, $input_too_long)
{
  $invalid_input_template = '<span class="invalid-input">%s</span><br>';
  $no_input_message_template = 'Please enter your %s.';
  $long_input_message_template = 'The %s you entered is too long.';

  if($has_submitted)
  {
    if($has_no_input) { echo sprintf($invalid_input_template, sprintf($no_input_message_template, $concerned_property)); }
    elseif ($input_too_long) { echo sprintf($invalid_input_template, sprintf($long_input_message_template, $concerned_property)); }
  }
}

function time_elapsed_string($datetime, $level = 7) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
  );
  foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
          unset($string[$k]);
      }
  }

  $string = array_slice($string, 0, $level);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function check_str_empty($str)
{
  return strlen($str) < 1;
}
?>