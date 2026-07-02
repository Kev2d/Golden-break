<?php
function child_theme_enqueue_styles()
{
    wp_enqueue_style('child-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'child_theme_enqueue_styles');

$theme_includes = [
    'theme/theme.php',
    'post-types/custom-post-types.php',
    'post-type-mods/blocks-emoji.php',
];

foreach ($theme_includes as $file) {
    $file_path = __DIR__ . '/functions/' . $file;
    if (file_exists($file_path)) {
        require_once $file_path;
    } else {
        error_log("Failed to include required theme file: {$file_path}");
    }
}
