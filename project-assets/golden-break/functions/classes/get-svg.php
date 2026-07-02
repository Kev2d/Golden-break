<?php

class GetSvg
{
    public static function import($path, $return = false)
    {
        $fullPath = get_template_directory() . $path;
        if (file_exists($fullPath)) {
            $svgContent = file_get_contents($fullPath);
            if ($return) {
                return $svgContent;
            } else {
                echo $svgContent;
            }
        }
    }
}
