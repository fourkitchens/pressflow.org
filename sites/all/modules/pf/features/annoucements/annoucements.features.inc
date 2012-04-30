<?php
/**
 * @file
 * annoucements.features.inc
 */

/**
 * Implements hook_node_info().
 */
function annoucements_node_info() {
  $items = array(
    'annoucements' => array(
      'name' => t('Annoucements'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
