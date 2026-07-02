<?php

class SvgRenderer
{
    /**
     * Fetch and render SVG content.
     *
     * @param string $file_path The URL or path to the SVG file.
     * @return string The SVG content or an empty string on failure.
     */
    public static function render($file_path)
    {
        // Only process SVG files
        $ext = pathinfo($file_path, PATHINFO_EXTENSION);
        if ($ext !== 'svg') {
            return '';
        }

        // Try fetching the SVG content
        $svg_content = @file_get_contents($file_path);

        // Optional: Handle local development cases like Docker
        if ($svg_content === false) {
            $parsed_path = parse_url($file_path, PHP_URL_PATH);
            $modified_url = 'http://host.docker.internal:8000' . $parsed_path;
            $svg_content = @file_get_contents($modified_url);
        }

        return $svg_content !== false ? $svg_content : ''; // Return the SVG or an empty string
    }
}
