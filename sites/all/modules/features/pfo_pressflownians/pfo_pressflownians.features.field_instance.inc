<?php
/**
 * @file
 * pfo_pressflownians.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function pfo_pressflownians_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance: 'node-pressflownians-field_pressflownian_logo'
  $field_instances['node-pressflownians-field_pressflownian_logo'] = array(
    'bundle' => 'pressflownians',
    'deleted' => 0,
    'description' => 'Upload a 24 bit PNG of the logo. See current homepage to match the current style.',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'image',
        'settings' => array(
          'image_link' => '',
          'image_style' => '',
        ),
        'type' => 'image',
        'weight' => 1,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_pressflownian_logo',
    'label' => 'Logo',
    'required' => 1,
    'settings' => array(
      'alt_field' => 0,
      'default_image' => 0,
      'file_directory' => '',
      'file_extensions' => 'png gif jpg jpeg',
      'max_filesize' => '',
      'max_resolution' => '',
      'min_resolution' => '',
      'title_field' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'image',
      'settings' => array(
        'preview_image_style' => 'thumbnail',
        'progress_indicator' => 'throbber',
      ),
      'type' => 'image_image',
      'weight' => 1,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Logo');
  t('Upload a 24 bit PNG of the logo. See current homepage to match the current style.');

  return $field_instances;
}
