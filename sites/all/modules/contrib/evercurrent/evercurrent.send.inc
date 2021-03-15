<?php

function evercurrent_run_update_check($key = NULL) {
  $key = $key ?: _evercurrent_get_key();
  if (!$key) {
    _evercurrent_write_status(RMH_STATUS_WARNING, 'Update check not run. No key');
    return FALSE;
  }
  if ($available = update_get_available(TRUE)) {
    module_load_include('inc', 'update', 'update.compare');
    $data = update_calculate_project_data($available);
  }
  else {
    _evercurrent_write_status(RMH_STATUS_WARNING, 'Unable to get available updates');
    drupal_set_message('Unable to get available updates');
    return FALSE;
  }
  global $base_url;
  $sender_data = array(
    'send_url' => variable_get('evercurrent_target_address', RMH_ENV_URL),
    'project_name' => _evercurrent_get_environment_url(),
    'key' => $key,
    'module_version' => '0',
    'api_version' => '0',
    'updates' => array(),
  );
  $status_list = array(
    UPDATE_NOT_SECURE,
    UPDATE_REVOKED,
    UPDATE_NOT_SUPPORTED,
    UPDATE_CURRENT,
    UPDATE_NOT_CHECKED,
    UPDATE_NOT_CURRENT
  );

  foreach ($data as $module => $module_info) {
    if (in_array($module_info['status'], $status_list, NULL)) {
      $sender_data['updates'][$module] = $data[$module];
      // In some cases (like multisite installations),
      // modules on certain paths are considered unimportant.
      $module_path = str_replace('/' . $module, '', drupal_get_path('module', $module));
      $sender_data['updates'][$module]['module_path'] = $module_path;
    }
  }

  // API version
  $sender_data['api_version'] = 2;

  // Module version
  $versions = system_get_info('module', 'evercurrent');
  $sender_data['module_version'] = $versions['version'];

  // Send active module data, to allow us to act on uninstalled modules
  $sender_data['enabled'] = module_list();

  // Retrieve active theme data
  $themes = list_themes(TRUE);
  foreach($themes AS $theme) {
    $machine_name = $theme->name;
    $sender_data['enabled'][$machine_name] = $machine_name;
  }

  // Retrieve active installation profile data.
  // We mark this as enabled send this if we are using an installation profile
  // that the Update Manager module also reports on. Otherwise, Evercurrent
  // will not tell us about updates for it.
  $install_profile = variable_get('install_profile');
  if ($install_profile && in_array($install_profile, array_keys($sender_data['updates']))) {
    $sender_data['enabled'][$install_profile] = $install_profile;
  }

  // Expose hook to add anything else.
  drupal_alter('evercurrent_update_data', $sender_data);

  $response = _evercurrent_send_updates($sender_data);
  return $response;
}

/**
 * Helper function.
 *
 * Retrieve a key from settings.php, or from variable.
 */
function _evercurrent_get_key() {
  $override = variable_get('evercurrent_override', FALSE);
  // Key from regular configuration
  $config_key = variable_get('evercurrent_environment_token', NULL);
  // Key from settings.php
  $settings_key = variable_get('evercurrent_key', NULL);
  return ($config_key && !$override) ? $config_key : $settings_key;
}

function _evercurrent_send_updates($sender_data) {
  $path = $sender_data['send_url'] . RMH_URL;
  $headers = array('Content-Type' => 'application/json');
  $data = drupal_json_encode($sender_data);
  $options = array(
    'headers' => $headers,
    'method' => 'POST',
    'data' => json_encode($sender_data),
  );

  $response = drupal_http_request($path, $options);

  if ($response->code != 200) {
    _evercurrent_write_status(RMH_STATUS_ERROR, 'Error code ' . $response->code . ' when trying to post to ' . $path);
  }
  else {
    // Check the response data, was it successful?
    $response_data = json_decode($response->data);
    if ($response_data) {
      $saved = $response_data->saved;
      if (!$saved) {
        _evercurrent_write_status(RMH_STATUS_ERROR, check_plain($response_data->message));
        return FALSE;
      }
      else {
        _evercurrent_write_status(RMH_STATUS_OK, $response_data->message);
        return TRUE;
      }
    }
  }
}

/**
 * Discontinues the process of sending updates.
 * Saves a status, message and last try time.
 *
 * @param $severity
 * @param $message
 */
function _evercurrent_write_status($severity, $message) {
  $message = check_plain($message);
  variable_set(RMH_STATUS, $severity);
  variable_set(RMH_STATUS_MESSAGE, $message);
  // If error, also log to watchdog.
  if ($severity == RMH_STATUS_ERROR) {
    watchdog('RMH', $message, array(), WATCHDOG_ERROR);
  }
  // If successful, set the last try timestamp
  if ($severity == RMH_STATUS_OK) {
    variable_set(RMH_LAST_TRY, time());
  }
}

/**
 * Helper function.
 *
 * Get an environment URL and ship together with the results.
 * First we see if we have our own explicit variable set. This
 * is only used for this purpose, and it allows the module
 * to be flexible in terms of determining the correct environment.
 *
 * If we do not find this variable, we fallback to the $base url.
 */
function _evercurrent_get_environment_url() {
  global $base_url;
  $env_url = variable_get('evercurrent_environment_url');
  // If env_url, send that.
  $url = $env_url ? $env_url : $base_url;
  return $url;
}
