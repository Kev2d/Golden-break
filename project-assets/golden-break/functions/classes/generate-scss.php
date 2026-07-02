<?php

require_once __DIR__ . '/theme-config.php';

class Scss_Generator
{
    public static function generate_scss()
    {
        Theme_Config::load_config();
        $scss_content = "// This file is generated from PHP file theme-config.php\n\n";
        $scss_content .= "\$screen-sm-min: " . Theme_Config::get_breakpoint('tablet') . "px;\n";
        $scss_content .= "\$screen-md-min: " . Theme_Config::get_breakpoint('small-laptop') . "px;\n";

        $file_path = __DIR__ . '/../../assets/scss/abstracts/_breakpoints.scss';

        // Open the file for writing, truncate the file to zero length
        $file = fopen($file_path, 'w');
        if ($file === false) {
            die("Failed to open file for writing: $file_path\n");
        }

        // Write the SCSS content to the file
        if (fwrite($file, $scss_content) === false) {
            fclose($file);
            die("Failed to write to file: $file_path\n");
        }

        // Close the file
        fclose($file);
    }
}

echo "Running generate_scss.php\n";
Scss_Generator::generate_scss();
echo "SCSS generation complete.\n";
