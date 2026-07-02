<?php

class Breadcrumbs
{
    public static function render()
    {
        // Define the home page link
        $home_link = home_url('/');
        $home_text = __('Home', 'textdomain'); // Make Home translatable

        // Start the breadcrumbs with the home link
        echo '<div class="site-breadcrumbs">';
        echo '<a class="site-breadcrumbs__item" href="' . $home_link . '">' . $home_text . '</a>';

        // Separator (using the GetSvg class)
        $separator = ' ' . GetSvg::import('/assets/img/icons/chevron-right.svg', true) . ' ';

        // Check if it is not the homepage
        if (!is_front_page()) {
            echo $separator;

            // For single posts (custom or regular)
            if (is_single()) {
                // Get the post type
                $post_type = get_post_type();
                
                if ($post_type === 'post') {
                    // If it's a regular blog post, show "Blog" as a translatable string
                    echo '<span class="site-breadcrumbs__item">' . __('Blog', 'textdomain') . '</span>';
                } else {
                    // For custom post types
                    if ($post_type) {
                        $post_type_object = get_post_type_object($post_type);
                        
                        // Display post type without archive link (since you don't have archives for them)
                        echo '<span class="site-breadcrumbs__item">' . $post_type_object->labels->singular_name . '</span>';
                    }
                }
                
                echo $separator;

                // Post title
                echo '<span class="site-breadcrumbs__item">' . get_the_title() . '</span>';

            } elseif (is_page()) {
                global $post;
                if ($post->post_parent) {
                    $parent_id  = $post->post_parent;
                    $breadcrumbs = array();
                    while ($parent_id) {
                        $page = get_page($parent_id);
                        $breadcrumbs[] = '<a class="site-breadcrumbs__item" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                        $parent_id  = $page->post_parent;
                    }
                    $breadcrumbs = array_reverse($breadcrumbs);
                    foreach ($breadcrumbs as $crumb) {
                        echo $crumb . $separator;
                    }
                }
                echo '<span class="site-breadcrumbs__item">' . get_the_title() . '</span>';

            } elseif (is_search()) {
                // Add a span with a class around the search query
                echo '<span class="site-breadcrumbs__item">Search results for: <span class="breadcrumb-title">' . get_search_query() . '</span></span>';
            } elseif (is_404()) {
                // Add a span with a class for the 404 title
                echo '<span class="site-breadcrumbs__item">Error 404</span>';
            } elseif (is_archive()) {
                // Get post type if it's a custom post type archive
                $post_type = get_post_type();
                if ($post_type) {
                    $post_type_object = get_post_type_object($post_type);
                    // Show archive link
                    echo '<a class="site-breadcrumbs__item" href="' . get_post_type_archive_link($post_type) . '">' . $post_type_object->labels->singular_name . '</a>';
                    echo $separator;
                }
                // Archive title
                echo '<span class="site-breadcrumbs__item">' . get_the_archive_title() . '</span>';
            }

            // Categories section (commented out, just in case you need it in future)
            /*
            if (is_category() || is_single()) {
                $categories = get_the_category();
                if ($categories) {
                    $category = $categories[0];
                    echo '<a class="site-breadcrumbs__item" href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>';
                    echo $separator;
                }
            }
            */
        }

        echo '</div>';
    }
}
