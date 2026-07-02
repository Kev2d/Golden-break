<?php
// Helper Function for Enqueuing Scripts and Styles
function enqueue_script_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all', $in_footer = false)
{
    $ext = pathinfo($src, PATHINFO_EXTENSION);
    // Check if the $src is a full URL or a relative path
    $src_url = filter_var($src, FILTER_VALIDATE_URL) ? $src : get_template_directory_uri() . $src;

    // Automatically set version based on file modification time for local files
    $ver = $ver ? $ver : (filter_var($src, FILTER_VALIDATE_URL) ? false : filemtime(get_stylesheet_directory() . $src));

    if ($ext === 'css') {
        wp_enqueue_style($handle, $src_url, $deps, $ver, $media);
    } elseif ($ext === 'js') {
        wp_enqueue_script($handle, $src_url, $deps, $ver, $in_footer);
    }
}

// Custom CSS and JS
function keweb_script_enqueue()
{
    // Enqueue Main CSS and JS
    enqueue_script_style('main-css', '/assets/dist/css/main.min.css');
    enqueue_script_style('main-js', '/assets/dist/js/main.min.js', array(), false, 'all', true);
}

// Hook into WordPress
add_action('wp_enqueue_scripts', 'keweb_script_enqueue');

// Menus
function keweb_theme_setup()
{
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('aside', 'image', 'video'));
    register_nav_menu('primary', 'Primary Header Navigation');
}

add_action('init', 'keweb_theme_setup');

function keweb_custom_logo_setup()
{
    $defaults = array(
        'height'      => 100, // Desired height of the logo in pixels.
        'width'       => 400, // Desired width of the logo in pixels.
        'flex-height' => true, // Allows the height to be flexible.
        'flex-width'  => true, // Allows the width to be flexible.
        'header-text' => array('site-title', 'site-description'), // Specifies which elements use the custom header text colors.
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'keweb_custom_logo_setup');

function keweb_customize_register($wp_customize)
{
    // Add a setting for the dark mode logo
    $wp_customize->add_setting('dark_mode_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url', // Ensures a valid URL is used
    ));

    // Add a control for the dark mode logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'dark_mode_logo_control', array(
        'label'    => __('Dark Mode Logo', 'golden-break'),
        'section'  => 'title_tagline', // Adds to the "Site Identity" section
        'settings' => 'dark_mode_logo',
        'priority' => 8, // Display order
    )));
}
add_action('customize_register', 'keweb_customize_register');


// Save all ACF JSONs to acf-json folder
function set_acf_json_save_folder($path)
{
    return get_template_directory() . '/acf-json';
}

add_filter('acf/settings/save_json', 'set_acf_json_save_folder');

// Load ACF JSON from the parent theme directory
function set_acf_json_load_folder($paths)
{
    $paths = array(get_template_directory() . '/acf-json');

    return $paths;
}

add_filter('acf/settings/load_json', 'set_acf_json_load_folder');


//Remove Appearance > Customize > Additional CSS

function mytheme_customize_register($wp_customize)
{
    $wp_customize->remove_section('custom_css');
}
add_action('customize_register', 'mytheme_customize_register');


// Allow SVG uploads by adding SVG MIME type to allowed mime types
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Enable SVG preview in Media Library by parsing SVG files for dimensions
function svg_preview($response, $attachment, $meta)
{
    if ($response['type'] === 'image' && $response['subtype'] === 'svg+xml' && class_exists('SimpleXMLElement')) {
        try {
            $path = get_attached_file($attachment->ID);
            if (file_exists($path)) {
                $svg = new SimpleXMLElement(file_get_contents($path));
                $src = $response['url'];
                $width = (int) $svg['width'];
                $height = (int) $svg['height'];

                if (!$width || !$height) {
                    $viewBox = explode(' ', $svg['viewBox']);
                    if (count($viewBox) === 4) {
                        $width = (int) $viewBox[2];
                        $height = (int) $viewBox[3];
                    }
                }

                $response = array_merge($response, array(
                    'image' => array(
                        'src' => $src,
                        'width' => $width,
                        'height' => $height,
                    ),
                ));
            }
        } catch (Exception $e) {
            // Handle any errors gracefully
        }
    }
    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'svg_preview', 10, 3);

// Bypass file type check for SVGs to ensure they are accepted by WordPress
function fix_svg_upload($data, $file, $filename, $mimes)
{
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext === 'svg') {
        $data['ext'] = 'svg';
        $data['type'] = 'image/svg+xml';
    }
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'fix_svg_upload', 10, 4);

// Sanitize SVG files during upload
function sanitize_svg($file)
{
    if ($file['type'] == 'image/svg+xml') {
        $file['file'] = wp_check_filetype_and_ext($file['file'], $file['name']);
    }
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'sanitize_svg');

function svg_sanitize_upload($checked, $file, $filename, $mimes)
{
    if (!$checked['type']) {
        $wp_filetype = wp_check_filetype_and_ext($file, $filename, $mimes);
        $ext = $wp_filetype['ext'];
        $type = $wp_filetype['type'];
        $proper_filename = $filename;

        if ($type && 0 === strpos($type, 'image/') && $ext !== 'svg') {
            $checked = compact('ext', 'type', 'proper_filename');
        } else {
            $checked['type'] = 'image/svg+xml';
            $checked['ext'] = 'svg';
            $checked['proper_filename'] = $filename;
        }
    }
    return $checked;
}
add_filter('wp_check_filetype_and_ext', 'svg_sanitize_upload', 10, 4);


//Remove checkbox to show title or description of site
function remove_header_text_customizer_option($wp_customize)
{
    // Remove the header text setting
    $wp_customize->remove_control('header_text');
}

add_action('customize_register', 'remove_header_text_customizer_option', 20);
