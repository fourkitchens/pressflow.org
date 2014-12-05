<?php

/**
 * Common database settings.
 *
 * Environment settings files should define the remainder of the
 * default array (or override it completely). At a bare minimum
 * the following should be defined:
 *
 *   $databases['default']['default']['database']
 *   $databases['default']['default']['username']
 *   $databases['default']['default']['password']
 */
$databases = array(
  'default' => array(
    'default' => array(
      'driver' => 'mysql',
      'host' => 'localhost',
      'prefix' => '',
    ),
  ),
);


/**
 * Access control for update.php script.
 */
$update_free_access = FALSE;

/**
 * Salt for one-time login links and cancel links, form tokens, etc.
 */
$drupal_hash_salt = '';

/**
 * PHP settings:
 */

/**
 * Some distributions of Linux (most notably Debian) ship their PHP
 * installations with garbage collection (gc) disabled. Since Drupal depends on
 * PHP's garbage collection for clearing sessions, ensure that garbage
 * collection occurs by using the most common settings.
 */
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);

/**
 * Set session lifetime (in seconds), i.e. the time from the user's last visit
 * to the active session may be deleted by the session garbage collector. When
 * a session is deleted, authenticated users are logged out, and the contents
 * of the user's $_SESSION variable is discarded.
 */
ini_set('session.gc_maxlifetime', 200000);

/**
 * Set session cookie lifetime (in seconds), i.e. the time from the session is
 * created to the cookie expires, i.e. when the browser is expected to discard
 * the cookie. The value 0 means "until the browser is closed".
 */
ini_set('session.cookie_lifetime', 2000000);

/**
 * Variable overrides.
 */
$conf['cache'] = 1;
$conf['block_cache'] = 1;
$conf['cache_lifetime'] = 300;
$conf['page_cache_maximum_age'] = 86400;
$conf['preprocess_css'] = 1;
$conf['preprocess_js'] = 1;

/**
 * Reverse proxy settings.
 */
$conf['reverse_proxy'] = TRUE;
$conf['reverse_proxy_addresses'] = array('127.0.0.1');

/**
 * Disable update manager downloads.
 */
$conf['allow_authorize_operations'] = FALSE;

/**
 * Google Analytics Code
 */
$conf['googleanalytics_account'] = 'UA-24112716-1';

/**
 * Environment specific settings.
 */
// Note - other subdomains (i.e. img.pressflow.org, etc) will need to be added
// to the live regex.
if (preg_match('/^(www)?pressflow\.org(:\d+)?$/', $_SERVER['HTTP_HOST'])) {
  // Live.
  include_once 'sites/default/settings.live.php';
}
elseif (preg_match('/^(.+\.)?stage.pressflow.org(:\d+)?$/', $_SERVER['HTTP_HOST'])) {
  // Stage.
  include_once 'sites/default/settings.stage.php';
}
else {
  include_once 'sites/default/settings.dev.php';
  $matches = array();
  if (strpos($_SERVER['HTTP_HOST'], 'local') !== FALSE && file_exists('sites/default/local.settings.php')) {
    include_once 'sites/default/local.settings.php';
  }
  elseif (preg_match('/^(.+)\..+\.pressflow\.org(:\d+)?$/', $_SERVER['HTTP_HOST'], $matches) &&
    file_exists('sites/default/' . $matches[1] . '.settings.php')
  ) {
    include_once 'sites/default/' . $matches[1] . '.settings.php';
  }
  elseif (preg_match('/^(.+)\..+\.webchefs\.org(:\d+)?$/', $_SERVER['HTTP_HOST'], $matches) &&
    file_exists('sites/default/' . $matches[1] . '.settings.php')
  ) {
    include_once 'sites/default/' . $matches[1] . '.settings.php';
  }
  elseif (file_exists('sites/default/' . getenv(USER) . '.settings.php')) {
    // If called from drush. It's better practice to use the -l flag, but
    // try to play nice in case a developer forgets it.
    include_once 'sites/default/' . getenv(USER) . '.settings.php';
  }
}

