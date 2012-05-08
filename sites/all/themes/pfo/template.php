<?php

/**
 * Implements theme_preprocess().
 */
function pfo_preprocess(&$vars) {
  // kpr($vars);
}

/**
 * Implements theme_preprocess_page().
 */
function pfo_preprocess_page(&$vars) {

  // Special treatment for front page
  if ($vars['is_front'] == TRUE) {

    // Download link for latest PRessflow release.
    // This URL will is built by Ian's github integration code.
    $vars['download'] = '<a href="###githubbb" id="download">Download!</a>';

    // Unset the page title
    $vars['title'] = '';
  }
}

/**
 * Implements theme_preprocess_node().
 */
function pfo_preprocess_node(&$vars) {

  // Special treatment for front page
  if ($vars['is_front'] == TRUE) {

    // Unset the page title
    $vars['title'] = '';
  }
}

/**
 * Implements pfo_preprocess_html().
 */
function pfo_preprocess_html(&$vars) {

  // Special treatment for front page
  if ($vars['is_front'] == TRUE) {

    // Set the <title> tag
    $vars['head_title'] = 'Pressflow | Enhanced performance and scalability for Drupal';
  }
}
