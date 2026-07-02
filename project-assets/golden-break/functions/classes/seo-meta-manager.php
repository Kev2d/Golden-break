<?php
class SEO_Meta_Manager
{
    public static function get_meta_tags()
    {
        $title = Custom_Title_Manager::get_title();
        $description = Custom_Title_Manager::get_description();
        $image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_template_directory_uri() . '/assets/img/defaultimages/og-image.png';
        $url = get_permalink();

        echo '<meta property="og:title" content="' . esc_attr($title) . '">' . PHP_EOL;
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . PHP_EOL;
        echo '<meta property="og:image" content="' . esc_url($image) . '">' . PHP_EOL;
        echo '<meta property="og:url" content="' . esc_url($url) . '">' . PHP_EOL;
        // Fix for og:type
        echo '<meta property="og:type" content="';
        if (is_singular('product')) {
            echo 'product';
        } elseif (is_singular('post')) {
            echo 'article';
        } else {
            echo 'website';
        }
        echo '">' . PHP_EOL;

        echo '<meta name="twitter:card" content="summary_large_image">' . PHP_EOL;
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . PHP_EOL;
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . PHP_EOL;
        echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . PHP_EOL;
    }
}

// Add this to the header
add_action('wp_head', ['SEO_Meta_Manager', 'get_meta_tags']);
