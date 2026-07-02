<?php
// Add custom checkbox selector field in WordPress menu editor
add_action('wp_nav_menu_item_custom_fields', 'custom_menu_checkbox_post_selector_field', 10, 4);
function custom_menu_checkbox_post_selector_field($item_id, $item, $depth, $args)
{
    if ($depth !== 0) return; // Only for Depth 1 items

    // Get saved post IDs
    $selected_posts = get_post_meta($item_id, '_menu_selected_posts', true);
    $selected_posts_array = !empty($selected_posts) ? explode(',', $selected_posts) : [];

    // Query posts to populate checkboxes
    $available_posts = get_posts([
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ]);

    // Scrollable container with checkboxes
    echo '<div class="custom-menu-field" style="margin: 10px 0; padding: 10px; background: #f9f9f9; border: 1px solid #ddd;">';
    echo '<label style="font-weight: bold; display: block; margin-bottom: 5px;">Select Posts</label>';
    echo '<div style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; padding: 5px; box-sizing: border-box;">';

    if (!empty($available_posts)) {
        foreach ($available_posts as $post) {
            $checked = in_array($post->ID, $selected_posts_array) ? 'checked' : '';
            echo '<div style="margin-bottom: 5px;">';
            echo '<label>';
            echo '<input type="checkbox" name="menu-selected-posts[' . $item_id . '][]" value="' . esc_attr($post->ID) . '" ' . $checked . '>';
            echo ' ' . esc_html($post->post_title);
            echo '</label>';
            echo '</div>';
        }
    } else {
        echo '<p>No posts found.</p>';
    }

    echo '</div>'; // End of scrollable container
    echo '</div>'; // End of field wrapper
}

// Save selected post IDs for menu items
add_action('wp_update_nav_menu_item', 'save_custom_menu_checkbox_post_selector', 10, 3);
function save_custom_menu_checkbox_post_selector($menu_id, $menu_item_db_id, $args)
{
    if (isset($_POST['menu-selected-posts'][$menu_item_db_id])) {
        // Get unique, sanitized post IDs
        $post_ids = array_unique(array_map('intval', $_POST['menu-selected-posts'][$menu_item_db_id]));

        // Save only if there are valid IDs
        if (!empty($post_ids)) {
            update_post_meta($menu_item_db_id, '_menu_selected_posts', implode(',', $post_ids));
        } else {
            delete_post_meta($menu_item_db_id, '_menu_selected_posts');
        }
    } else {
        delete_post_meta($menu_item_db_id, '_menu_selected_posts');
    }
}


// Load saved post data into the menu item object
add_filter('wp_setup_nav_menu_item', 'load_custom_menu_checkbox_post_selector');
function load_custom_menu_checkbox_post_selector($menu_item)
{
    $post_ids = get_post_meta($menu_item->ID, '_menu_selected_posts', true);
    $menu_item->selected_posts = !empty($post_ids) ? explode(',', $post_ids) : [];
    return $menu_item;
}
