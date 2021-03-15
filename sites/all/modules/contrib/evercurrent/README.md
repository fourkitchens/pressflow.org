# Evercurrent module

Install this module to be able to communicate the site's update status
with the Evercurrent server at https://app.evercurrent.io

### To install:

- Enable the Evercurrent module on you site
- Set up a site on the RMS server
- Fill in your API key in the settings form at admin/config/evercurrent.

### Url Validation
In addition to your key, the Evercurrent module identifies itself to the server with you site's base url.
If your server is not configured with the Drupal best-practice $base_url parameter in settings.php, 
your server will not always be able to report current environment url, especially if Drush is running Cron.
If this is the case for you, the module's reporting URL can be set specifically for the Evercurrent module in settings.php with:

        $conf['evercurrent_environment_url'] = 'https://my-production-site'

##### Disabling URL validation (not recommended)
It is important that you let the server know the url from where the environment should receive updates from,
especially if you are running multiple environments (like dev + stage + production).

You can disable the server's validation of the URL, on your site settings at the Evercurrent Server. 
This will make the server only validate your API key. 

**Warning:** This may lead to the Evercurrent Server to accept updates from any dev environments you have that are configured with the key.

### Configure key in settings.php
You can also configure your key directly in settings.php:

        $conf['evercurrent_environment_token'] = 'your-api-key'

By configuring the key in your settings.php, you can easily setup sites to listen to specific environments, in addition to your production environment.

### To use:
- Updates will be sent to the RMP server at cron run.
- You will be able to see a summary about your available updates at your account at https://app.evercurrent.io/
- You will be able to receive useful email reports about your site's update status.
