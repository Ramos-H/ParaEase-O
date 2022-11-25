<?php
function boolToStr($value)
{
  return $value ? 'true' : 'false';
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