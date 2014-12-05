<?php
/**
 * @file
 * pfo_pressflownians.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function pfo_pressflownians_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "context" && $api == "context") {
    return array("version" => "3");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function pfo_pressflownians_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function pfo_pressflownians_node_info() {
  $items = array(
    'pressflownians' => array(
      'name' => t('Pressflownians'),
      'base' => 'node_content',
      'description' => t('People who use Pressflow!'),
      'has_title' => '1',
      'title_label' => t('Name'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
