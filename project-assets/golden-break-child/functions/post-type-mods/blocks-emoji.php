<?php
/**
 * Add Emoji Meta Box to Block Post Type
 */
function add_emoji_meta_box() {
    add_meta_box(
        'block_emoji', // Unique ID
        __('Block Emoji', 'keweb'), // Box title
        'block_emoji_meta_box_html', // Content callback
        'block', // Post type
        'side', // Context (where to display: side, normal, etc.)
        'default' // Priority
    );
}
add_action('add_meta_boxes', 'add_emoji_meta_box');

/**
 * Meta Box HTML for Emoji Input
 */
function block_emoji_meta_box_html($post) {
    $emoji = get_post_meta($post->ID, '_block_emoji', true);
    ?>
    <label for="block_emoji"><?php _e('Enter Emoji:', 'keweb'); ?></label>
    <input type="text" id="block_emoji" name="block_emoji" value="<?php echo esc_attr($emoji); ?>" maxlength="5" pattern="[\u{1F600}-\u{1F64F}]" style="width:100%;">
    <?php
}

/**
 * Save Emoji Meta Box Data
 */
function save_block_emoji_meta($post_id) {
    if (array_key_exists('block_emoji', $_POST)) {
        // Basic validation to make sure it's an emoji (length = 1)
        $emoji = sanitize_text_field($_POST['block_emoji']);
        if (mb_strlen($emoji) < 6) {
            update_post_meta($post_id, '_block_emoji', $emoji);
        }
    }
}
add_action('save_post', 'save_block_emoji_meta');
?>
