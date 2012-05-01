<?php

/**
 * @file
 *   drush integration for modernizr.
 */

/**
 * Implementation of hook_drush_command().
 *
 * In this hook, you specify which commands your
 * drush module makes available, what it does and
 * description.
 *
 * Notice how this structure closely resembles how
 * you define menu hooks.
 *
 * @See drush_parse_command() for a list of recognized keys.
 *
 * @return
 *   An associative array describing your command(s).
 */
function modernizr_drush_command() {
  $items = array();

  $items['modernizr-download-dev'] = array(
    'callback' => 'modernizr_drush_download_dev',
    'description' => dt('Downloads the dev version of Modernizr from http://www.modernizr.com/downloads/modernizr-2.5.3.js'),
    'aliases' => array('moddld'),
    'arguments' => array(
      'path' => dt('Optional. A path to the modernizr module. If omitted Drush will use the default location.'),
    ),
  );
  return $items;
}

/**
 * Implementation of hook_drush_help().
 *
 * This function is called whenever a drush user calls
 * 'drush help <name-of-your-command>'
 *
 * @param
 *   A string with the help section (prepend with 'drush:')
 *
 * @return
 *   A string with the help text for your command.
 */
function modernizr_drush_help($section) {
  switch ($section) {
    case 'drush:modernizr-download-dev':
      return dt("Downloads the dev version of Modernizr from http://www.modernizr.com/downloads/modernizr-2.5.3.js. Include an optional destination path.");
  }
}

/**
 * Downloads the full, development copy of Modernizr
 */
function modernizr_drush_download_dev() {
  $args = func_get_args();
  if ($args[0]) {
    $path = $args[0];
  }
  else {
    $path = drush_get_context('DRUSH_DRUPAL_ROOT');
    if (module_exists('libraries')) {
      $path .= '/' . libraries_get_path('modernizr');
    }
    else {
      $path .= '/' . drupal_get_path('module', 'modernizr') . '/js';
    }
  }

  // Create the path if it does not exist yet.
  if (!is_dir($path)) {
    drush_mkdir($path);
  }

  if (is_dir($path . '/arc')) {
    drush_log('Modernizr already present. No download required.', 'ok');
  }
  elseif (drush_op('chdir', $path) &&
    drush_shell_exec('wget http://www.modernizr.com/downloads/modernizr-2.5.3.js')) {
      drush_log(dt('The latest Modernizr dev library has been downloaded to @path', array('@path' => $path)), 'success');
  }
  else {
    drush_log(dt('Drush was unable to download Modernizr dev to @path', array('@path' => $path)), 'error');
  }
}

/**
 * Implements drush_MODULE_post_COMMAND().
 */
function drush_modernizr_post_pm_enable() {
  $extensions = func_get_args();
  // Deal with comma delimited extension list.
  if (strpos($extensions[0], ',') !== FALSE) {
    $extensions = explode(',', $extensions[0]);
  }

  if (in_array('modernizr', $extensions) && !drush_get_option('skip')) {
    modernizr_drush_download_dev();
  }
}
