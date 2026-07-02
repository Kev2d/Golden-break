<?php

// Add a checkbox field to the WordPress settings page
function add_maintenance_mode_checkbox()
{
    add_settings_section('maintenance_settings_section', 'Maintenance Mode', '', 'reading');
    add_settings_field('maintenance_mode_checkbox', 'Enable Maintenance Mode', 'maintenance_mode_checkbox_html', 'reading', 'maintenance_settings_section');
    register_setting('reading', 'maintenance_mode_checkbox', 'sanitize_callback');
}

function maintenance_mode_checkbox_html()
{
    $maintenance_mode = get_option('maintenance_mode_checkbox');
?>
    <label>
        <input type="checkbox" name="maintenance_mode_checkbox" value="1" <?php checked($maintenance_mode, 1); ?>>
        <?php echo __('Enable maintenance mode', 'keweb'); ?>
    </label>
<?php
}

function sanitize_callback($input)
{
    return isset($input) ? 1 : 0;
}

add_action('admin_init', 'add_maintenance_mode_checkbox');


// Activate maintenance mode if the checkbox is checked
function activate_maintenance_mode()
{
    $maintenance_mode = get_option('maintenance_mode_checkbox');
    if ($maintenance_mode && !current_user_can('manage_options')) {
        require_once(get_template_directory() . '/maintenance.php');
        exit();
    }
}

add_action('template_redirect', 'activate_maintenance_mode');
