<?php

class Theme_Config
{
    private static $config;

    public static function load_config()
    {
        if (self::$config === null) {
            $config_path = __DIR__ . '/../theme/theme-config.php';
            if (!file_exists($config_path)) {
                die("Configuration file not found: $config_path\n");
            }
            self::$config = include $config_path;
        }
    }

    public static function get($key, $default = null)
    {
        self::load_config();
        return self::$config[$key] ?? $default;
    }

    public static function get_breakpoint($size)
    {
        self::load_config();
        return self::$config['breakpoints'][$size] ?? null;
    }
}
