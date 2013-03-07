# UglifyJS

This module allows on-the-fly minification of site JavaScript with [uglify.js](https://github.com/mishoo/UglifyJS/).

The module relies on a web service ([uglify.me](http://uglify.me)) by default to do
the minification so you do not need to do any pre-processing on your server to enjoy
the benefits of minified JavaScript.

## How it works

The uglifyjs module can minify scripts either individually or all together after
core concatenates scripts.

### ```hook_uglifyjs_info()```

If you're on core Drupal or are
using a version of [Pressflow](http://pressflow.org) prior to 7.20.1 you will need
to implement ```hook_uglifyjs_info()``` and provide an array of scripts that are
safe to minify.

Here's an example of how ```hook_uglifyjs_info()``` works:

```php
function hook_uglifyjs_info() {
  // Surface some known JS files that are safe to minify.
  $scripts = array(
    // Core.
    'misc/ajax.js',
    'misc/authorize.js',
    'misc/autocomplete.js',
    'misc/batch.js',
    'misc/collapse.js',
    'misc/drupal.js',
    'misc/form.js',
    'misc/jquery.ba-bbq.js',
    'misc/jquery.cookie.js',
    'misc/jquery.form.js',
    'misc/jquery.js',
    'misc/jquery.once.js',
    'misc/machine-name.js',
    'misc/progress.js',
    'misc/states.js',
    'misc/tabledrag.js',
    'misc/tableheader.js',
    'misc/tableselect.js',
    'misc/textarea.js',
    'misc/timezone.js',
    'misc/vertical-tabs.js'
  );

  return $scripts;
}
```

The downside of this approach is that every file listed will generate a request to the
webservice. This can be very time consuming on a cold cache and could result in page
timeouts.

### ```hook_js_cache_alter()```

Alternatively, if you're running a version of Pressflow greater than 7.20.1 and you
have JavaScript minification enabled, the module will automatically use
```hook_js_cache_alter()```. This is preferable to ```hook_uglifyjs_info()``` because
it requires fewer requests to the web service and will return results much faster.

## Developent

To disable minification set the ```uglifyjs_skip_uglify``` variable to ```TRUE``` either
with drush or in your settings file:

```php
$conf['uglifyjs_skip_uglify'] = TRUE;
```
