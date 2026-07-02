<?php
class Custom_Title_Manager
{
    public static function get_title()
    {
        // Check if a custom title is set for the current page or post
        $custom_title = get_post_meta(get_the_ID(), '_custom_page_title', true);

        if ($custom_title) {
            return $custom_title;
        }

        // Default logic for titles
        if (is_front_page()) {
            // For the homepage, return only the site name
            return get_bloginfo('name');
        } else {
            // For other pages, return "Site Name | Page Title"
            return get_bloginfo('name') . ' | ' . get_the_title();
        }
    }

    public static function get_description()
    {
        // Check if a custom description is set for the current page or post
        $custom_description = get_post_meta(get_the_ID(), '_custom_page_description', true);

        if ($custom_description) {
            return $custom_description;
        }

        // Fallback to the site description
        return get_bloginfo('description');
    }

    public static function register_meta_boxes()
    {
        add_action('add_meta_boxes', function () {
            add_meta_box(
                'custom_meta_box',
                'Custom Title and Description',
                [__CLASS__, 'render_meta_box'],
                ['post', 'page'], // Meta box for posts, pages, and the front page
                'normal',
                'default'
            );
        });

        add_action('save_post', function ($post_id) {
            // Skip auto-saves or invalid requests
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
            if (!isset($_POST['custom_page_title']) || !isset($_POST['custom_page_description'])) return;

            // Save the custom title and description
            update_post_meta($post_id, '_custom_page_title', sanitize_text_field($_POST['custom_page_title']));
            update_post_meta($post_id, '_custom_page_description', sanitize_textarea_field($_POST['custom_page_description']));
        });
    }

    public static function render_meta_box($post)
    {
        // Retrieve current values for the fields
        $custom_title = get_post_meta($post->ID, '_custom_page_title', true);
        $custom_description = get_post_meta($post->ID, '_custom_page_description', true);
        ?>
        <p>
            <label for="custom_page_title">Custom Title:</label>
            <input type="text" id="custom_page_title" name="custom_page_title"
                   value="<?php echo esc_attr($custom_title); ?>" class="widefat">
        </p>
        <p>
            <label for="custom_page_description">Custom Description:</label>
            <textarea id="custom_page_description" name="custom_page_description"
                      rows="4" class="widefat"><?php echo esc_textarea($custom_description); ?></textarea>
        </p>
        <?php
    }
}

// Initialize the class and register the meta boxes
Custom_Title_Manager::register_meta_boxes();
?>
