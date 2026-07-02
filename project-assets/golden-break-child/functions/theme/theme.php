<?php
// Helper Function for Enqueuing Styles (CSS only)
function enqueue_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all')
{
    // Check if the $src is a full URL or a relative path
    $src_url = filter_var($src, FILTER_VALIDATE_URL) ? $src : get_stylesheet_directory_uri() . $src;

    // If no version is provided, use the file modification time (for local files)
    if (!$ver && !filter_var($src, FILTER_VALIDATE_URL)) {
        $file_path = get_stylesheet_directory() . $src;
        if (file_exists($file_path)) {
            $ver = filemtime($file_path);
        }
    }

    wp_enqueue_style($handle, $src_url, $deps, $ver, $media);
}

// Custom CSS Enqueue
function keweb_style_enqueue()
{
    // Enqueue Main CSS
    enqueue_style('child-main-css', '/assets/dist/css/main.min.css', array('child-style'));
}

// Hook the function to enqueue styles
add_action('wp_enqueue_scripts', 'keweb_style_enqueue');
