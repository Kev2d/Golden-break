<?php
class PrimaryNavWalker extends Walker_Nav_Menu
{
    private $is_mobile;

    public function __construct($is_mobile = false)
    {
        $this->is_mobile = $is_mobile;
    }

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '<ul class="sub-menu">';

        if ($depth === 0) {
            $output .= '<li class="site-nav-links"><ul>';
        }

        if ($this->is_mobile) {
            ob_start();
            get_template_part('template-parts/UI/back-button', null, [
                'function' => 'back-to-previous-menu',
                'label' => __('Back to previous menu', 'keweb')
            ]);
            $back_button_html = ob_get_clean();

            $output .= '<li class="nav-item-controls">' . $back_button_html . '</li>';
        }
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $site_nav_links_marker = '<li class="site-nav-links">';
        $has_site_nav_posts = false;

        if ($depth === 0 && isset($args->menu_item_id)) {
            $selected_posts = get_post_meta($args->menu_item_id, '_menu_selected_posts', true);
            $post_ids = !empty($selected_posts) ? explode(',', $selected_posts) : [];

            if (!empty($post_ids)) {
                $has_site_nav_posts = true;

                // Close the default site-nav-links container
                $output .= '</ul></li>';

                // Add site-nav-posts container and items
                $output .= '<li class="site-nav-posts"><ul>';
                foreach ($post_ids as $post_id) {
                    $post = get_post($post_id);
                    if ($post) {
                        $post_title = esc_html($post->post_title);
                        $post_link  = esc_url(get_permalink($post_id));
                        $post_image = get_the_post_thumbnail($post_id, 'mobile-image', ['loading' => 'lazy']);

                        $output .= '<li class="site-nav-posts__item">';
                        $output .= '<a href="' . $post_link . '">';
                        if ($post_image) {
                            $output .= '<div class="site-nav-posts__image">' . $post_image . '</div>';
                        }
                        $output .= '<div class="site-nav-posts__title"><p>' . $post_title . '</p></div>';
                        $output .= '</a></li>';
                    }
                }
                $output .= '</ul></li>';
            } else {
                // Close site-nav-links even if no posts exist
                $output .= '</ul></li>';
            }
        }

        if (!$this->is_mobile && $depth === 0) {
            $close_svg = GetSvg::import('/assets/img/icons/close.svg', true);
            $output .= '<li class="nav-item-close"><button aria-label="' . __('Close submenu', 'keweb') . '" data-function="close-nav-menu">' . $close_svg . '</button></li>';
        }

        // Add the limited-grid class conditionally to only the correct site-nav-links
        if ($has_site_nav_posts) {
            // Replace only the LAST occurrence of <li class="site-nav-links"> before site-nav-posts
            $last_occurrence_pos = strrpos($output, $site_nav_links_marker);
            if ($last_occurrence_pos !== false) {
                $output = substr_replace(
                    $output,
                    '<li class="site-nav-links site-nav-links--limited-grid">',
                    $last_occurrence_pos,
                    strlen($site_nav_links_marker)
                );
            }
        }

        $output .= '</ul>';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        if ($depth === 0) {
            $args->menu_item_id = $item->ID;
        }

        $has_children = in_array('menu-item-has-children', $item->classes);

        $output .= '<li id="menu-item-' . $item->ID . '" class="' . implode(' ', $item->classes) . '">';
        $output .= '<a href="' . esc_url($item->url) . '">' . $item->title;

        if (($this->is_mobile || $depth === 0) && $has_children) {
            $chevron_svg = $this->is_mobile ? GetSvg::import('/assets/img/icons/chevron-right.svg', true) : GetSvg::import('/assets/img/icons/chevron-down.svg', true);
            $output .= ' <span class="chevron">' . $chevron_svg . '</span>';
        }

        $output .= '</a>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= '</li>';
    }
}
