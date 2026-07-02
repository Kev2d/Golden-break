<?php

class ThemeManager
{
    // Define a static method to get the theme from a cookie
    public static function getTheme()
    {
        // Normalize the domain by removing any port (e.g., localhost:8000 becomes localhost)
        $domainParts = explode(':', $_SERVER['HTTP_HOST']); // Split domain and port
        $domain = str_replace('.', '_', $domainParts[0]); // Replace dots with underscores to match JavaScript

        $themeCookieName = $domain . '_theme'; // Example: "localhost_theme"

        // Return the cookie value if set; otherwise return null
        return isset($_COOKIE[$themeCookieName]) && $_COOKIE[$themeCookieName] !== ''
            ? esc_attr($_COOKIE[$themeCookieName])
            : 'light';
    }
}
