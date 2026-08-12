<?php

/**
 * Return the configured GA4 measurement ID when it is valid.
 */
function golden_break_get_ga4_measurement_id()
{
    if (!function_exists('get_field')) {
        return '';
    }

    $measurement_id = strtoupper(trim((string) get_field('ga4_measurement_id', 'option')));

    return preg_match('/^G-[A-Z0-9]+$/', $measurement_id) ? $measurement_id : '';
}

/**
 * Load the Google tag in the document head.
 */
function golden_break_enqueue_ga4()
{
    $measurement_id = golden_break_get_ga4_measurement_id();

    if (!$measurement_id) {
        return;
    }

    wp_enqueue_script(
        'golden-break-ga4',
        'https://www.googletagmanager.com/gtag/js?id=' . rawurlencode($measurement_id),
        array(),
        null,
        array(
            'strategy'  => 'async',
            'in_footer' => false,
        )
    );

    $encoded_measurement_id = wp_json_encode($measurement_id);

    wp_add_inline_script(
        'golden-break-ga4',
        "window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', {$encoded_measurement_id});",
        'after'
    );
}
add_action('wp_enqueue_scripts', 'golden_break_enqueue_ga4');

/**
 * Keep the saved value normalized and reject malformed measurement IDs.
 */
function golden_break_format_ga4_measurement_id($value)
{
    return strtoupper(trim((string) $value));
}
add_filter('acf/update_value/name=ga4_measurement_id', 'golden_break_format_ga4_measurement_id');

function golden_break_validate_ga4_measurement_id($valid, $value)
{
    if ($valid !== true || $value === '') {
        return $valid;
    }

    if (!preg_match('/^G-[A-Z0-9]+$/', golden_break_format_ga4_measurement_id($value))) {
        return 'Enter a valid GA4 Measurement ID, for example G-XXXXXXXXXX.';
    }

    return $valid;
}
add_filter('acf/validate_value/name=ga4_measurement_id', 'golden_break_validate_ga4_measurement_id', 10, 2);
