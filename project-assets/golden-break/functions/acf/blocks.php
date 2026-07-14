<?php

function golden_break_block_categories($categories, $post)
{
    $categories[] = array(
        'slug'  => 'golden-break',
        'title' => __('Golden Break', 'golden-break'),
    );

    return array_reverse($categories);
}
add_filter('block_categories', 'golden_break_block_categories', 1, 2);

function golden_break_register_acf_blocks()
{
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    $block_types = array(
        array(
            'name' => 'hero',
            'title' => __('Hero Block', 'golden-break'),
            'description' => __('Hero slider used at the top of a page.', 'golden-break'),
            'render_template' => 'acf-blocks/hero-block.php',
            'icon' => 'welcome-view-site',
            'keywords' => array('hero', 'slider', 'header'),
        ),
        array(
            'name' => 'textimageblock',
            'title' => __('Text Image Block', 'golden-break'),
            'description' => __('Text content paired with an image or video.', 'golden-break'),
            'render_template' => 'acf-blocks/text-image-block.php',
            'icon' => 'align-pull-left',
            'keywords' => array('text', 'image', 'video'),
        ),
        array(
            'name' => 'stats-strip-block',
            'title' => __('Stats Strip Block', 'golden-break'),
            'description' => __('A compact card with a title and statistics.', 'golden-break'),
            'render_template' => 'acf-blocks/stats-strip-block.php',
            'icon' => 'chart-bar',
            'keywords' => array('stats', 'numbers', 'strip'),
        ),
        array(
            'name' => 'features-block',
            'title' => __('Features Block', 'golden-break'),
            'description' => __('A grid of feature or booking-step cards.', 'golden-break'),
            'render_template' => 'acf-blocks/features-block.php',
            'icon' => 'grid-view',
            'keywords' => array('features', 'steps', 'grid'),
        ),
        array(
            'name' => 'contact-form-block',
            'title' => __('Contact Form Block', 'golden-break'),
            'description' => __('A section containing a contact form.', 'golden-break'),
            'render_template' => 'acf-blocks/contact-form-block.php',
            'icon' => 'email-alt',
            'keywords' => array('contact', 'form', 'email'),
        ),
        array(
            'name' => 'contact-map-block',
            'title' => __('Contact Map Block', 'golden-break'),
            'description' => __('Contact details, directions, and an embedded map.', 'golden-break'),
            'render_template' => 'acf-blocks/contact-map-block.php',
            'icon' => 'location-alt',
            'keywords' => array('contact', 'map', 'directions'),
        ),
        array(
            'name' => 'price-list-block',
            'title' => __('Price List Block', 'golden-break'),
            'description' => __('Pricing cards with features and links.', 'golden-break'),
            'render_template' => 'acf-blocks/price-list-block.php',
            'icon' => 'money',
            'keywords' => array('price', 'pricing', 'cards'),
        ),
        array(
            'name' => 'price-table-block',
            'title' => __('Price Table Block', 'golden-break'),
            'description' => __('A detailed pricing table.', 'golden-break'),
            'render_template' => 'acf-blocks/price-table-block.php',
            'icon' => 'list-view',
            'keywords' => array('price', 'table', 'pricing'),
        ),
        array(
            'name' => 'info-note-block',
            'title' => __('Info Note Block', 'golden-break'),
            'description' => __('A bordered note or information list.', 'golden-break'),
            'render_template' => 'acf-blocks/info-note-block.php',
            'icon' => 'info',
            'keywords' => array('note', 'info', 'list'),
        ),
        array(
            'name' => 'atmosphere-block',
            'title' => __('Atmosphere Block', 'golden-break'),
            'description' => __('A gallery preview with title and link.', 'golden-break'),
            'render_template' => 'acf-blocks/atmosphere-block.php',
            'icon' => 'format-gallery',
            'keywords' => array('atmosphere', 'gallery', 'images'),
        ),
        array(
            'name' => 'gallery-block',
            'title' => __('Gallery Block', 'golden-break'),
            'description' => __('A centered image gallery grid.', 'golden-break'),
            'render_template' => 'acf-blocks/gallery-block.php',
            'icon' => 'format-gallery',
            'keywords' => array('gallery', 'images', 'photos'),
        ),
        array(
            'name' => 'location-block',
            'title' => __('Location Block', 'golden-break'),
            'description' => __('Location highlights with an embedded map.', 'golden-break'),
            'render_template' => 'acf-blocks/location-block.php',
            'icon' => 'location-alt',
            'keywords' => array('location', 'map', 'address'),
        ),
        array(
            'name' => 'cta-block',
            'title' => __('CTA Block', 'golden-break'),
            'description' => __('A centered call-to-action section.', 'golden-break'),
            'render_template' => 'acf-blocks/cta-block.php',
            'icon' => 'megaphone',
            'keywords' => array('cta', 'buttons', 'booking'),
        ),
        array(
            'name' => 'booking-info-block',
            'title' => __('Booking Info Block', 'golden-break'),
            'description' => __('Booking rules and contact information cards.', 'golden-break'),
            'render_template' => 'acf-blocks/booking-info-block.php',
            'icon' => 'clipboard',
            'keywords' => array('booking', 'rules', 'contact'),
        ),
        array(
            'name' => 'title-text-block',
            'title' => __('Title Text Block', 'golden-break'),
            'description' => __('A title with accompanying formatted text.', 'golden-break'),
            'render_template' => 'acf-blocks/title-text-block.php',
            'icon' => 'editor-textcolor',
            'keywords' => array('title', 'text', 'content'),
        ),
    );

    foreach ($block_types as $block_type) {
        $block_type['category'] = 'golden-break';
        acf_register_block_type($block_type);
    }
}
add_action('acf/init', 'golden_break_register_acf_blocks');
