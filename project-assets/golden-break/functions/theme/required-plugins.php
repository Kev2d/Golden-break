<?php

add_filter('plugin_action_links', function ($actions, $plugin_file) {
    // List of required plugins
    $required_plugins = [
        'advanced-custom-fields-pro/acf.php'
    ];

    // Remove the deactivate link for the required plugins
    if (in_array($plugin_file, $required_plugins, true)) {
        unset($actions['deactivate']);
    }

    return $actions;
}, 10, 2);
