<?php

/**
* This settings.php file contains the settings for Pressflow.org
*/

include_once 'core.settings.php';
include_once 'globals.settings.php';

// Will include local settings if it exists, if not, will supress errors.
@include_once 'local.settings.php';
