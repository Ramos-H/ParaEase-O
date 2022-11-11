<?php 
  // Debugging
  define('DEBUG_MODE', false);

  // MAX LIMITS
  define('MAX_LENGTH_NAME_FIRST', DEBUG_MODE ? 10 : 65535);
  define('MAX_LENGTH_NAME_LAST', DEBUG_MODE ? 10 : 65535);
  define('MAX_LENGTH_EMAIL', DEBUG_MODE ? 10 : 65535);
  define('MAX_LENGTH_SUBJECT', DEBUG_MODE ? 10 : 65535);
  define('MAX_LENGTH_MESSAGE', DEBUG_MODE ? 10 : 65535);
?>