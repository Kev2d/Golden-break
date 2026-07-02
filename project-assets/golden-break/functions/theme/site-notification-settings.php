<?php
class Custom_Theme_Settings_Admin
{
    public function __construct()
    {
        // Register the admin menu and settings
        add_action('admin_menu', [$this, 'register_admin_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    /**
     * Registers the admin page under the WordPress menu.
     */
    public function register_admin_page()
    {
        add_menu_page(
            'Site Notification',   // Page title
            'Site Notification',          // Menu title
            'manage_options',          // Capability required
            'custom-theme-settings',   // Slug for the settings page
            [$this, 'render_admin_page'], // Callback to render the page
            'dashicons-admin-settings' // Icon for the menu
        );
    }

    /**
     * Renders the admin page.
     */
    public function render_admin_page()
    {
?>
        <div class="wrap">
            <h1>Custom Theme Settings</h1>
            <form method="post" action="options.php">
                <?php
                // Output settings fields and sections
                settings_fields('custom_theme_settings');
                do_settings_sections('custom-theme-settings');
                submit_button();
                ?>
            </form>
        </div>
<?php
    }

    /**
     * Registers settings for the theme settings page.
     */
    public function register_settings()
    {
        // Register the description field
        register_setting('custom_theme_settings', 'custom_theme_description', [
            'type' => 'string',
            'sanitize_callback' => 'wp_kses_post', // Allow HTML for formatting
            'default' => 'Default description...',
        ]);

        // Add the main settings section
        add_settings_section(
            'custom_theme_main_section',  // Section ID
            'Main Theme Settings',        // Title of the section
            null,                         // Callback (null because no description is needed)
            'custom-theme-settings'       // Page slug
        );

        // Add the description field
        add_settings_field(
            'custom_theme_description',
            'Theme Description',
            [$this, 'description_field_callback'],
            'custom-theme-settings',
            'custom_theme_main_section'
        );
    }

    /**
     * Callback for rendering the description editor field.
     */
    public function description_field_callback()
    {
        $description = get_option('custom_theme_description', 'Default description...');

        wp_editor($description, 'custom_theme_description_editor', [
            'textarea_name' => 'custom_theme_description',
            'media_buttons' => false,
            'teeny' => true,
            'quicktags' => true,
        ]);
    }
}

// Initialize the admin class
new Custom_Theme_Settings_Admin();
