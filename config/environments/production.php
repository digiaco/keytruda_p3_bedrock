<?php
/**
 * You should try to keep staging as close to production as possible. However,
 * should you need to, you can always override production configuration values
 * with `Config::define`.
 *
 * Example: `Config::define('WP_DEBUG', true);`
 * Example: `Config::define('DISALLOW_FILE_MODS', false);`
 */

use Roots\WPConfig\Config;
use function Env\env;

Config::define('AS3CF_SETTINGS',
 serialize(
     [
         'provider' => env('ASSETS_PROVIDER'),
         'access-key-id' => env('ASSETS_KEY'),
         'secret-access-key' => env('ASSETS_SECRET'),
         'bucket' => env('ASSETS_BUCKET'),
         'object-prefix' => 'app/' . env('WP_HOST'),
         'serve-from-s3' => '1',
         'copy-to-s3' => '1',
         'use-bucket-acls' => '1',
         'remove-local-file' => '0',
         'object-versioning' => 0
     ]
 )
);