<?php

/**
 * WP Security Enhancements
 */

// Remove WordPress Version Number
function wpb_remove_version()
{
  return '';
}
add_filter('the_generator', 'wpb_remove_version');

// Customize Login Error Message
function no_wordpress_errors()
{
  return 'Something is wrong!';
}
add_filter('login_errors', 'no_wordpress_errors');

// Disable REST API User Endpoints
function disable_rest_api_user_endpoints($endpoints)
{
  if (isset($endpoints['/wp/v2/users'])) {
    unset($endpoints['/wp/v2/users']);
  }
  if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
    unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
  }
  return $endpoints;
}
add_filter('rest_endpoints', 'disable_rest_api_user_endpoints');

// Prevent User Enumeration via URL
function prevent_user_enumeration()
{
  if (is_admin()) {
    return;
  }

  if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) {
    die();
  }

  add_filter('redirect_canonical', 'shapeSpace_check_enum', 10, 2);
}
add_action('init', 'prevent_user_enumeration');

function shapeSpace_check_enum($redirect, $request)
{
  if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) {
    die();
  } else {
    return $redirect;
  }
}

// Remove Welcome Panel in Dashboard
remove_action('welcome_panel', 'wp_welcome_panel');

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Disable Theme File Editor
define('DISALLOW_FILE_EDIT', true);

// ACF Settings
add_filter('acf/settings/remove_wp_meta_box', '__return_false');
