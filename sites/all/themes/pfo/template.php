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

  global $base_url;

  // Special treatment for front page
  if ($vars['is_front'] == TRUE) {

    // Unset the page title
    $vars['title'] = '';

    // Set the prerender tag for FAQs. Our analytics show an overwhelming number (~50%) of users
    // landing on the homepage that proceed to /faq, making this a very reasonable optimization.
    //
    // Further reading: https://developers.google.com/chrome/whitepapers/prerender
    drupal_add_html_head_link(array(
      'rel'  => 'prerender',
      'href' => $base_url . '/faq',
    ));
  }

  // Generate the version number
  if (module_exists('pf')) {
    $version = pf_pull_pressflow_version();
  }
  else {
    $version = 'latest';
  }

  // Build the download link. Points to Pressflow 6 direct download.
  $vars['download'] = '<a href="https://github.com/pressflow/6/tarball/master" id="download">ver '. $version .'</a>';
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

  // Help re-format the 'submitted by' output. See node.tpl.php
  // - Generate date in shorter format
  // - Drop the dash separating date and time
  // - Replace it with the word 'at'
  $prep_date = format_date($vars['created'], 'medium');
  $prep_date = explode('-', $prep_date);
  $prep_date = implode(' at ', $prep_date);
  $vars['date'] = $prep_date;

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

/**
 * Implements hook_js_alter()
 *
 * Moves most scripts to the bottom of the page, save for a whitelist
 * @TODO: figure out how to whitelist inline JS, e.g. M.load() calls
 */
function pfo_js_alter(&$js) {
  // Collect the scripts we want in to remain in the header scope.
  $whitelist = array(
    'sites/all/libraries/modernizr/modernizr.min.js',
  );

  // Change the default scope of external scripts to footer.
  // Code assumes if the script is scoped to header it was done so by default.
  foreach ($js as $key => &$script) {
    if ($script['scope'] == 'header' && !in_array($script['data'], $whitelist)) {
      $script['scope'] = 'footer';
    }
  }
}
