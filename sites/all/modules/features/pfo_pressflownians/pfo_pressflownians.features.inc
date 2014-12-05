<?php
/**
 * @file
 * pfo_pressflownians.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function pfo_pressflownians_ctools_plugin_api() {
  list($module, $api) = func_get_args();
  if ($module == "context" && $api == "context") {
    return array("version" => "3");
  }
}

/**
 * Implements hook_views_api().
 */
function pfo_pressflownians_views_api() {
  return array("version" => "3.0");
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
  return $items;
}
