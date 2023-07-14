<?php
# TODO: Figure out what exact PHP version and config Backdrop wants
error_reporting(E_ALL ^ E_DEPRECATED);

$database = 'mysql://root:root@db/backdrop';

$config_directories['active'] = '/workspace/data/config/active';
$config_directories['staging'] = '/workspace/data/config/staging';

# TODO: We need a different, safe, random unchanging hash per project stored outside the webroot
$settings['hash_salt'] = $settings['hash_salt'] = 'todo';

ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);

ini_set('session.gc_maxlifetime', 200000);
ini_set('session.cookie_lifetime', 2000000);

$settings['backdrop_drupal_compatibility'] = TRUE;
$settings['file_private_path'] = '/workspace/data/files/private';
$settings['file_public_path'] = '/workspace/data/files/public';