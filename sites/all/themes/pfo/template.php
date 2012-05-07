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
  // kpr($vars);

  $vars['download'] = '<a href="###githubbb">Download!</a>'; // this URL will be (at least partially) built by Ian's github integration code.
}
