<?php

/**
* This settings.php file contains the settings for Pressflow.org
*/

include_once 'core.settings.php';
include_once 'globals.settings.php';

if (!defined('PANTHEON_ENVIRONMENT')) {
  // Will include local settings if it exists, if not, will supress errors. To
  // avoid any deley on production, we only check for this on not Pantheon.
  @include_once 'local.settings.php';
}
