<?php

if( class_exists('acf_field') ) {

    class acf_field_select_post_types extends acf_field {

        // Constructor
        function __construct() {
            $this->name = 'select_post_types';
            $this->label = __('Select Post Types', 'golden-break');
            $this->category = 'choice';
            $this->defaults = array(
                'post_types' => array() // No options initially
            );

            parent::__construct();
        }

        // Render field settings (in ACF UI, this is backend only)
        function render_field_settings( $field ) {
            // No specific settings required for now, you can add more if needed later.
        }

        // Render the field (in backend editor)
        function render_field( $field ) {
            // Get all post types
            $post_types = get_post_types(array('public' => true), 'objects');
            
            // Start the dropdown for single selection
            echo '<select name="' . esc_attr($field['name']) . '">';  // Single select without []
            
            // Optionally, you can have a placeholder or empty option
            echo '<option value="">' . __('Select a Post Type', 'golden-break') . '</option>';
            
            // Loop through each post type and create an option
            foreach ( $post_types as $post_type ) {
                // Check if the post type is selected
                $selected = $post_type->name == $field['value'] ? 'selected' : '';
                echo '<option value="' . esc_attr($post_type->name) . '" ' . $selected . '>' . esc_html($post_type->label) . '</option>';
            }

            // Close the dropdown
            echo '</select>';
        }

        // Ensure field value is saved correctly
        function update_value( $value, $post_id, $field ) {
            return sanitize_text_field( $value );
        }
    }

    // Hook into ACF to include the custom field
    add_action('acf/include_field_types', 'include_field_select_post_types'); // v5+

    function include_field_select_post_types($version) {
        new acf_field_select_post_types(); // Only call this once here
    }
}
