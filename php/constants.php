<?php 
  // Debugging
  define('DEBUG_MODE', false);

  // Database
  define('DB_HOST', 'localhost');
  define('DB_USER', 'paraiso_server');
  define('DB_PASS', 'PalawanParadise');
  define('DB_NAME', 'db_paraiso');

  // MAX LIMITS
  define('MAX_LENGTH_NAME_FIRST', DEBUG_MODE ? 10 : 65535);
  define('MAX_LENGTH_NAME_LAST', DEBUG_MODE ? 10 : 65535);
  define('MAX_LENGTH_EMAIL', DEBUG_MODE ? 10 : 65535);
  define('MAX_LENGTH_SUBJECT', DEBUG_MODE ? 10 : 65535);
  define('MAX_LENGTH_MESSAGE', DEBUG_MODE ? 10 : 65535);
?>