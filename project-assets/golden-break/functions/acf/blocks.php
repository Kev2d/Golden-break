<?php

function keweb_block_categories($categories, $post)
{
    $categories[] = [
        'slug' => 'golden-break',
        'title' => __('Golden Break', 'golden-break')
    ];

    return array_reverse($categories);
}
add_filter('block_categories', 'keweb_block_categories', 1, 2);

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types()
{


    if (function_exists('acf_register_block_type')) {

        acf_register_block_type(array(
            'name'              => 'hero',
            'title'             => __('Hero Block'),
            'description'       => __('Hero Block used for site header.'),
            'render_template'   => 'acf-blocks/hero-block.php',
            'category'          => 'golden-break',
            'icon'              => 'welcome-view-site',
            'keywords'          => array('hero', 'hero block', 'header'),
        ));

        acf_register_block_type(array(
            'name'              => 'textimageblock',
            'title'             => __('Text Image Block'),
            'description'       => __('Text Image Block.'),
            'render_template'   => 'acf-blocks/text-image-block.php',
            'category'          => 'golden-break',
            'icon'              => 'email',
            'keywords'          => array('textimageblock'),
        ));

        acf_register_block_type(array(
            'name'              => 'banner',
            'title'             => __('Banner Block'),
            'description'       => __('Banner Block used for prominent site sections.'),
            'render_template'   => 'acf-blocks/banner-block.php',
            'category'          => 'golden-break',
            'icon'              => 'megaphone',
            'keywords'          => array('banner', 'banner block', 'promo'),
        ));

        acf_register_block_type(array(
            'name'              => 'text-image-cta',
            'title'             => __('Text Image CTA Block'),
            'description'       => __('A custom block with text, image, and call to action.'),
            'render_template'   => 'acf-blocks/text-image-cta-block.php',
            'category'          => 'golden-break',
            'icon'              => 'images-alt2',
            'keywords'          => array('text', 'image', 'cta'),
        ));

        acf_register_block_type(array(
            'name'              => 'small-banner',
            'title'             => __('Small Banner Block'),
            'description'       => __('Small Banner Block used for smaller site sections.'),
            'render_template'   => 'acf-blocks/small-banner-block.php',
            'category'          => 'golden-break',
            'icon'              => 'admin-site-alt3',
            'keywords'          => array('small banner', 'banner block', 'promo'),
        ));

        acf_register_block_type(array(
            'name'              => 'text-stats',
            'title'             => __('Text Stats Block'),
            'description'       => __('A block that displays text with accompanying statistics.'),
            'render_template'   => 'acf-blocks/text-stats-block.php',
            'category'          => 'golden-break',
            'icon'              => 'chart-bar',
            'keywords'          => array('text', 'stats', 'statistics', 'data'),
        ));

        acf_register_block_type(array(
            'name'              => 'stats-strip-block',
            'title'             => __('Stats Strip Block'),
            'description'       => __('A compact card with a title and statistics.'),
            'render_template'   => 'acf-blocks/stats-strip-block.php',
            'category'          => 'golden-break',
            'icon'              => 'chart-bar',
            'keywords'          => array('stats', 'statistics', 'numbers', 'strip', 'block'),
        ));

        acf_register_block_type(array(
            'name'              => 'features-block',
            'title'             => __('Features Block'),
            'description'       => __('A block that displays key features in a grid layout.'),
            'render_template'   => 'acf-blocks/features-block.php',
            'category'          => 'golden-break',
            'icon'              => 'grid-view',
            'keywords'          => array('features', 'grid', 'steps', 'benefits'),
        ));

        acf_register_block_type(array(
            'name'              => 'promo-block',
            'title'             => __('Promo Block'),
            'description'       => __('A block that highlights promotional content with text and an image.'),
            'render_template'   => 'acf-blocks/promo-block.php',
            'category'          => 'golden-break',
            'icon'              => 'star-filled',
            'keywords'          => array('promo', 'highlight', 'promotion', 'banner'),
        ));

        acf_register_block_type(array(
            'name'              => 'icon-text-block',
            'title'             => __('Icon Text Block'),
            'description'       => __('A block that displays an icon alongside text.'),
            'render_template'   => 'acf-blocks/icon-text-block.php',
            'category'          => 'golden-break',
            'icon'              => 'admin-customizer',
            'keywords'          => array('icon', 'text', 'feature', 'info'),
        ));

        acf_register_block_type(array(
            'name'              => 'latest-posts-block',
            'title'             => __('Latest Posts Block'),
            'description'       => __('A block that displays the latest posts.'),
            'render_template'   => 'acf-blocks/latest-posts-block.php',
            'category'          => 'golden-break',
            'icon'              => 'admin-post',
            'keywords'          => array('latest', 'posts', 'recent', 'blog', 'articles'),
        ));

        acf_register_block_type(array(
            'name'              => 'contact-info-block',
            'title'             => __('Contact Info Block'),
            'description'       => __('A custom block to display contact information.'),
            'render_template'   => 'acf-blocks/contact-info-block.php',
            'category'          => 'golden-break',
            'icon'              => 'phone',
            'keywords'          => array('contact', 'info', 'address', 'phone', 'email'),
        ));

        acf_register_block_type(array(
            'name'              => 'contact-form-block',
            'title'             => __('Contact Form Block'),
            'description'       => __('A custom block to display a contact form.'),
            'render_template'   => 'acf-blocks/contact-form-block.php',
            'category'          => 'golden-break',
            'icon'              => 'email-alt',
            'keywords'          => array('contact', 'form', 'email', 'message'),
        ));

        acf_register_block_type(array(
            'name'              => 'contact-map-block',
            'title'             => __('Contact Map Block'),
            'description'       => __('A contact details section with direction notes and an embedded map.'),
            'render_template'   => 'acf-blocks/contact-map-block.php',
            'category'          => 'golden-break',
            'icon'              => 'location-alt',
            'keywords'          => array('contact', 'map', 'address', 'directions', 'location'),
        ));

        acf_register_block_type(array(
            'name'              => 'accordion-block',
            'title'             => __('Accordion Block'),
            'description'       => __('A custom block for displaying collapsible accordion content.'),
            'render_template'   => 'acf-blocks/accordion-block.php',
            'category'          => 'golden-break',
            'icon'              => 'list-view',
            'keywords'          => array('accordion', 'collapse', 'toggle', 'expand'),
        ));

        acf_register_block_type(array(
            'name'              => 'content-features-block',
            'title'             => __('Content Features Block'),
            'description'       => __('A custom block for displaying content features like image/video addition, text customization, and more.'),
            'render_template'   => 'acf-blocks/content-features-block.php',
            'category'          => 'golden-break',
            'icon'              => 'admin-settings',
            'keywords'          => array('content', 'features', 'customization', 'images', 'videos'),
        ));

        acf_register_block_type(array(
            'name'              => 'text-image-list-block',
            'title'             => __('Text Image List Block'),
            'description'       => __('A custom block for displaying text, an image, and a list.'),
            'render_template'   => 'acf-blocks/text-image-list-block.php',
            'category'          => 'golden-break',
            'icon'              => 'format-image',
            'keywords'          => array('text', 'image', 'list', 'custom', 'block'),
        ));

        acf_register_block_type(array(
            'name'              => 'content-overview-block',
            'title'             => __('Content Overview Block'),
            'description'       => __('A custom block to display an overview of different content sections.'),
            'render_template'   => 'acf-blocks/content-overview-block.php',
            'category'          => 'golden-break',
            'icon'              => 'welcome-widgets-menus',
            'keywords'          => array('content', 'overview', 'navigation', 'custom', 'block'),
        ));

        acf_register_block_type(array(
            'name'              => 'posts-display-block',
            'title'             => __('Posts Display Block'),
            'description'       => __('A custom block to display posts in various layouts.'),
            'render_template'   => 'acf-blocks/posts-display-block.php',
            'category'          => 'golden-break',
            'icon'              => 'grid-view',
            'keywords'          => array('posts', 'display', 'custom', 'block', 'layout'),
        ));
        acf_register_block_type(array(
            'name'              => 'price-list-block',
            'title'             => __('Price List Block'),
            'description'       => __('A custom block to display a price list in various layouts.'),
            'render_template'   => 'acf-blocks/price-list-block.php',
            'category'          => 'golden-break',
            'icon'              => 'money',
            'keywords'          => array('price', 'list', 'cost', 'block', 'layout'),
        ));
        acf_register_block_type(array(
            'name'              => 'price-table-block',
            'title'             => __('Price Table Block'),
            'description'       => __('A custom block to display a pricing table.'),
            'render_template'   => 'acf-blocks/price-table-block.php',
            'category'          => 'golden-break',
            'icon'              => 'list-view',
            'keywords'          => array('price', 'table', 'cost', 'block', 'layout'),
        ));
        acf_register_block_type(array(
            'name'              => 'info-note-block',
            'title'             => __('Info Note Block'),
            'description'       => __('A bordered note list for important information.'),
            'render_template'   => 'acf-blocks/info-note-block.php',
            'category'          => 'golden-break',
            'icon'              => 'info',
            'keywords'          => array('note', 'info', 'notice', 'list', 'block'),
        ));
        acf_register_block_type(array(
            'name'              => 'atmosphere-block',
            'title'             => __('Atmosphere Block'),
            'description'       => __('A custom block to display a gallery section with title and link.'),
            'render_template'   => 'acf-blocks/atmosphere-block.php',
            'category'          => 'golden-break',
            'icon'              => 'format-gallery',
            'keywords'          => array('atmosphere', 'gallery', 'images', 'photos', 'block'),
        ));
        acf_register_block_type(array(
            'name'              => 'gallery-block',
            'title'             => __('Gallery Block'),
            'description'       => __('A centered image gallery grid.'),
            'render_template'   => 'acf-blocks/gallery-block.php',
            'category'          => 'golden-break',
            'icon'              => 'format-gallery',
            'keywords'          => array('gallery', 'images', 'photos', 'grid', 'block'),
        ));
        acf_register_block_type(array(
            'name'              => 'location-block',
            'title'             => __('Location Block'),
            'description'       => __('A custom block to display location highlights with a map image.'),
            'render_template'   => 'acf-blocks/location-block.php',
            'category'          => 'golden-break',
            'icon'              => 'location-alt',
            'keywords'          => array('location', 'map', 'address', 'contact', 'block'),
        ));
        acf_register_block_type(array(
            'name'              => 'cta-block',
            'title'             => __('CTA Block'),
            'description'       => __('A centered call to action section with primary and secondary links.'),
            'render_template'   => 'acf-blocks/cta-block.php',
            'category'          => 'golden-break',
            'icon'              => 'megaphone',
            'keywords'          => array('cta', 'call to action', 'buttons', 'booking', 'block'),
        ));
        acf_register_block_type(array(
            'name'              => 'title-text-block',
            'title'             => __('Title Text Block'),
            'description'       => __('A custom block to display a title with accompanying text.'),
            'render_template'   => 'acf-blocks/title-text-block.php',
            'category'          => 'golden-break',
            'icon'              => 'editor-textcolor',
            'keywords'          => array('title', 'text', 'heading', 'block', 'content'),
        ));
        acf_register_block_type(array(
            'name'              => 'regular-image-block',
            'title'             => __('Regular Image Block'),
            'description'       => __('A custom block to display an image styled and sized according to the template.'),
            'render_template'   => 'acf-blocks/regular-image-block.php',
            'category'          => 'golden-break',
            'icon'              => 'format-image',
            'keywords'          => array('image', 'photo', 'media', 'block', 'content'),
        ));
        acf_register_block_type(array(
            'name'              => 'selected-jobs-block',
            'title'             => __('Selected Jobs Block'),
            'description'       => __('Selected Jobs Block.'),
            'render_template'   => 'acf-blocks/selected-jobs-block.php',
            'category'          => 'golden-break',
            'icon'              => 'email',
            'keywords'          => array('selected', 'jobs', 'block'),
        ));
        acf_register_block_type(array(
            'name'              => 'features-secondary-block',
            'title'             => __('Features Secondary Block'),
            'description'       => __('Features Secondary Block.'),
            'render_template'   => 'acf-blocks/features-secondary-block.php',
            'category'          => 'golden-break',
            'icon'              => 'email',
            'keywords'          => array('features', 'block'),
        ));
        acf_register_block_type(array(
            'name'              => 'feedback-block',
            'title'             => __('Feedback Block'),
            'description'       => __('Feedback Block.'),
            'render_template'   => 'acf-blocks/feedback-block.php',
            'category'          => 'golden-break',
            'icon'              => 'format-chat',
            'keywords'          => array('feedback', 'block'),
        ));
    }
}
