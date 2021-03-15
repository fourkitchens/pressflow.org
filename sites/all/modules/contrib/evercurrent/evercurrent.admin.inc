<?php

/**
 * Evercurrent settings form.
 */
function evercurrent_settings_form() {
  if (variable_get('evercurrent_listen', FALSE)) {
    $link = l(
      'Maintenance Server',
      variable_get('evercurrent_target_address', RMH_ENV_URL),
      array('external' => TRUE));
    $msg = t('The Evercurrent module is listening for arriving API key from the Maintenance
    server.<br>
    Go to the !link and add/configure your site, then click Complete
    Setup', array('!link' => $link));
    drupal_set_message($msg, 'warning', FALSE);
  }
  $form['evercurrent_send'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable sending update reports'),
    '#description' => t('Check this to enable sending information about available updates to the Evercurrent server.'),
    '#default_value' => variable_get('evercurrent_send', 1),
    '#weight' => 1
  );
  $form['evercurrent_target_address'] = array(
    '#type' => 'textfield',
    '#title' => t('Server URL'),
    '#description' => t('The target environment URL'),
    '#default_value' => variable_get('evercurrent_target_address', RMH_ENV_URL),
    '#weight' => 2
  );
  $form['evercurrent_key'] = array(
    '#type' => 'textfield',
    '#title' => t('API Key'),
    '#description' => t("The API key for this site. It should contain only lower
      case letters and numbers. If you have development and staging environments,
      you should not store the API key in this field, but in your production
      environment's settings.php as follows:
      <code>\$conf['evercurrent_environment_token'] = 'your-api-key';</code>
      This is important if you are using different environments. See this module's
      documentation for more information."),
    '#size' => 60,
    '#maxlength' => 32,
    '#default_value' => variable_get('evercurrent_key'),
    '#weight' => 4
  );
  $form['advanced'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#title' => t('Advanced'),
    '#weight' => 5
  );

  $form['advanced']['evercurrent_listen'] = array(
    '#type' => 'checkbox',
    '#title' => t('Listen for new API key'),
    '#description' => t('If set, the module will listen for an API key sent from
      the Maintenance server. Once it has received an API key, it will
      immediately attempt to send updates to the maintenance server using this
      API key. If this update succeeds, the API key will be saved. When it is
      saved, the listening will be automatically stopped.'),
    '#default_value' => variable_get('evercurrent_listen', 1),
  );

  $form['advanced']['evercurrent_interval'] = array(
    '#type' => 'select',
    '#title' => t('Frequency'),
    '#description' => t('The default frequency for sending updates to the
      server. Use this if your cron runs very often.'),
    '#default_value' => variable_get('evercurrent_interval', 3600),
    '#options' => array(
      0 => t('Every time cron runs'),
      3600 => t('Every hour'),
      43200 => t('Every 12 hours'),
      86400 => t('Every 24 hours'),
    ),
    '#weight' => 4
  );

  if (variable_get('evercurrent_environment_token', FALSE)) {
    $form['evercurrent_override'] = array(
      '#type' => 'checkbox',
      '#title' => t('Override key stored in settings.php'),
      '#description' => t(
        "An API key <code>%key</code> has been detected in your site's
        settings.php file. If you want to override that key, check this box. The
        API key in the <strong>API key</strong> field below will then be used
        instead.",
        array('%key' => variable_get('evercurrent_environment_token'))
      ),
      '#default_value' => variable_get('evercurrent_override', 0),
      '#weight' => 3
    );
    $form['evercurrent_key']['#states'] = array(
      'disabled' => array(
        ':input[name="evercurrent_override"]' => array('checked' => FALSE),
      )
    );
  }
  $form['evercurrent_send_now'] = array(
    '#type' => 'checkbox',
    '#title' => t('Send update report when saving configuration'),
    '#description' => t('If this is checked, Evercurrent will attempt to send updates
      to the server immediately after you have saved this form.'),
    '#weight' => 10
  );
  $form['#submit'][] = 'evercurrent_send_update_submit';
  $form['actions'] = array(
    'submit' => array(
      '#type' => 'submit',
      '#value' => t('Save configuration')
    ),
    '#weight' => 100
  );

  return $form;
}

function evercurrent_send_update_submit($form, $form_state) {
  system_settings_form_submit($form, $form_state);
  $values = $form_state['values'];
  if ($values['evercurrent_send_now'] == TRUE) {
    // Specify the key if override is checked, to use the newly entered key.
    $key = NULL;
    if (isset($values['evercurrent_override'])){
      $key = $values['evercurrent_override'] ? $values['evercurrent_key'] : NULL;
    }
    module_load_include('inc', 'evercurrent', 'evercurrent.send');
    if (evercurrent_run_update_check($key)) {
      drupal_set_message('Triggered an update to the server.');
    }
    else {
      drupal_set_message('An error occurred while trying to send an update.', 'error');
    }
  }
}
