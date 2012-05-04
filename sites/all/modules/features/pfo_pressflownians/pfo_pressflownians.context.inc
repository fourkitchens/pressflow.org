<?php
/**
 * @file
 * pfo_pressflownians.context.inc
 */

/**
 * Implements hook_context_default_contexts().
 */
function pfo_pressflownians_context_default_contexts() {
  $export = array();

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'pressflownians';
  $context->description = '';
  $context->tag = '';
  $context->conditions = array(
    'path' => array(
      'values' => array(
        '<front>' => '<front>',
      ),
    ),
  );
  $context->reactions = array(
    'block' => array(
      'blocks' => array(
        'views-pressflownians-block' => array(
          'module' => 'views',
          'delta' => 'pressflownians-block',
          'region' => 'content',
          'weight' => '-10',
        ),
      ),
    ),
  );
  $context->condition_mode = 0;
  $export['pressflownians'] = $context;

  return $export;
}
