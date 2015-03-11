<?php


/**
 * Any global configuation variables.
 *
 * i.e. $conf['var_name'] = 'value';
 */


/**
 * Variable overrides.
 */
$conf['cache'] = 1;
$conf['block_cache'] = 1;
$conf['cache_lifetime'] = 0;
$conf['page_cache_maximum_age'] = 86400;
$conf['preprocess_css'] = 1;
$conf['preprocess_js'] = 1;

/**
 * Google Analytics Code.
 *   Set to nothing unless on the production environment (below).
 */
$conf['googleanalytics_account'] = '';



// All Pantheon Environments.
if (defined('PANTHEON_ENVIRONMENT')) {
  // Use Redis for caching.
  $conf['redis_client_interface'] = 'PhpRedis';
  $conf['cache_backends'][] = 'sites/all/modules/contrib/redis/redis.autoload.inc';
  $conf['cache_default_class'] = 'Redis_Cache';
  $conf['cache_prefix'] = array('default' => 'pantheon-redis');
  // Do not use Redis for cache_form (no performance difference).
  $conf['cache_class_cache_form'] = 'DrupalDatabaseCache';
  // Use Redis for Drupal locks (semaphore).
  $conf['lock_inc'] = 'sites/all/modules/contrib/redis/redis.lock.inc';

  // High performance - no hook_boot(), no hook_exit(), ignores Drupal IP blacklists.
  $conf['page_cache_without_database'] = TRUE;
  $conf['page_cache_invoke_hooks'] = FALSE;
  // Explicitly set page_cache_maximum_age as database won't be available.
  $conf['page_cache_maximum_age'] = 900;


  /**
   * Disable update manager downloads.
   */
  $conf['allow_authorize_operations'] = FALSE;


  if (PANTHEON_ENVIRONMENT == 'live') {
    // Remove WWW.
    if ($_SERVER['HTTP_HOST'] == 'www.pressflow.org' ||
        $_SERVER['HTTP_HOST'] == 'live-pressflow-org.pantheon.io') {
      header('HTTP/1.0 301 Moved Permanently');
      header('Location: http://pressflow.org'. $_SERVER['REQUEST_URI']);
      exit();
    }
    /**
     * Google Analytics Code
     */
    $conf['googleanalytics_account'] = 'UA-24112716-1';
  }
}
