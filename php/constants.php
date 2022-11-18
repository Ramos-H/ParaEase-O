<?php 
  // Debugging
  define('DEBUG_MODE', true);

  // Database
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'db_paraiso');

  // MAX LIMITS
  define('MAX_LENGTH_NAME_FIRST', DEBUG_MODE ? 30 : 65535);
  define('MAX_LENGTH_NAME_LAST',  DEBUG_MODE ? 30 : 65535);
  define('MAX_LENGTH_EMAIL',      DEBUG_MODE ? 30 : 65535);
  define('MAX_LENGTH_SUBJECT',    DEBUG_MODE ? 30 : 65535);
  define('MAX_LENGTH_MESSAGE',    DEBUG_MODE ? 30 : 65535);

  define('PACKAGE_COUNT', 3);
?>