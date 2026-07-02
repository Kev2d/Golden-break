<?php

function custom_login()
{
    global $pagenow;

    if ('wp-login.php' == $pagenow && !is_user_logged_in()) {

        if (isset($_GET['action']) && in_array($_GET['action'], array('lostpassword', 'rp', 'resetpass'))) {
            // If it's a password reset or lost password action, allow the default process
            return;
        }

        $login_error = null;  // Initialize a variable for the login error

        if (isset($_POST['log']) && isset($_POST['pwd'])) {
            $creds = array(
                'user_login'    => sanitize_text_field($_POST['log']),
                'user_password' => sanitize_text_field($_POST['pwd']),
                'remember'      => isset($_POST['rememberme'])
            );

            $user = wp_signon($creds, false);

            if (is_wp_error($user)) {
                // Instead of echoing, capture the error message
                $login_error = $user->get_error_message();
            } else {
                wp_set_auth_cookie($user->ID, $creds['remember'], true);
                wp_redirect(admin_url());
                exit();
            }
        }

        require_once(get_template_directory() . '/custom-login.php');
        exit();
    }
}

add_action('init', 'custom_login');

add_filter('lostpassword_url', function ($lostpassword_url, $redirect) {
    return site_url('wp-login.php?action=lostpassword', 'login');
}, 10, 2);