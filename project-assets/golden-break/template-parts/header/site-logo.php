<?php
$custom_logo_id = get_theme_mod('custom_logo');
$dark_logo_url = get_theme_mod('dark_mode_logo');
$default_logo_url = get_stylesheet_directory_uri() . '/assets/img/defaultimages/keweblogo.svg';
$default_dark_logo_url = get_stylesheet_directory_uri() . '/assets/img/defaultimages/keweblogo-white.svg';
$default_alt = 'Keweblogo';

// Function to render logos
function render_logo($logo_input, $default_url, $default_alt, $extra_attributes = '')
{
    $logo_url = $default_url;
    $logo_alt = $default_alt;
    $fallback_width = '200'; // Fallback dimensions
    $fallback_height = '42';

    // Check if input is an ID or URL
    if (is_numeric($logo_input)) {
        $logo_id = $logo_input;
        $logo_url = wp_get_attachment_image_url($logo_id, 'full');
        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true) ?: $default_alt;
    } elseif (filter_var($logo_input, FILTER_VALIDATE_URL)) {
        $logo_url = $logo_input;
        $logo_id = attachment_url_to_postid($logo_url);
        $logo_alt = $logo_id ? (get_post_meta($logo_id, '_wp_attachment_image_alt', true) ?: $default_alt) : $default_alt;
    }

    // Handle SVG files
    if ($logo_url && strpos($logo_url, '.svg') !== false) {
        $svg_content = @file_get_contents($logo_url);

        if ($svg_content !== false) {
            libxml_use_internal_errors(true);
            $svg = simplexml_load_string($svg_content, 'SimpleXMLElement', LIBXML_NOCDATA);

            if ($svg) {
                $width = (string) $svg['width'] ?: $fallback_width;
                $height = (string) $svg['height'] ?: $fallback_height;

                $attributes = trim(
                    "$extra_attributes " .
                        "width=\"$width\" height=\"$height\""
                );

                return str_replace('<svg ', "<svg $attributes ", $svg->asXML());
            }
        }
    }

    // Handle standard image types
    $dimensions = @getimagesize($logo_url);
    $width_attr = isset($dimensions[0]) ? 'width="' . esc_attr($dimensions[0]) . '"' : 'width="' . $fallback_width . '"';
    $height_attr = isset($dimensions[1]) ? 'height="' . esc_attr($dimensions[1]) . '"' : 'height="' . $fallback_height . '"';

    return '<img src="' . esc_url($logo_url) . '" ' . $width_attr . ' ' . $height_attr .
        ' alt="' . esc_attr($logo_alt) . '" ' . $extra_attributes . '>';
}

// Render each logo separately
if (!empty($custom_logo_id)) : ?>
    <div class="site-logo" data-element="light">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php esc_attr_e('Go to homepage', 'golden-break'); ?>">
            <?php echo render_logo($custom_logo_id, $default_logo_url, $default_alt); ?>
        </a>
    </div>
<?php endif;

if (!empty($dark_logo_url)) : ?>
    <div class="site-logo" data-element="dark">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php esc_attr_e('Go to homepage', 'golden-break'); ?>">
            <?php echo render_logo($dark_logo_url, $default_dark_logo_url, $default_alt); ?>
        </a>
    </div>
<?php endif; ?>