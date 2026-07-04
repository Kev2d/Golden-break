<?php
$theme_includes = [
  'theme/theme.php',
  'theme/maintenance.php',
  'theme/required-plugins.php',
  'theme/custom-login.php',
  'theme/theme-image-sizes.php',
  'theme/site-notification-settings.php',
  'acf/blocks.php',
  'acf/options.php',
  'acf/wysiwyg-editor.php',
  'acf/field-modifications.php',
  'acf/post-types-option.php',
  'security/security.php',
  'classes/get-svg.php',
  'classes/theme-config.php',
  'classes/breadcrumbs.php',
  'classes/svgrenderer.php',
  'classes/custom-document-title-manager.php',
  'classes/seo-meta-manager.php',
  'walkers/primary-nav-walker.php',
];

foreach ($theme_includes as $file) {
  $file_path = __DIR__ . '/functions/' . $file;
  if (file_exists($file_path)) {
    require_once $file_path;
  } else {
    error_log("Failed to include required theme file: {$file_path}");
  }
}
