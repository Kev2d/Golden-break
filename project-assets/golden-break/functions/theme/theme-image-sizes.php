<?php

add_action('after_setup_theme', 'keweb_image_sizes_setup');
function keweb_image_sizes_setup()
{
    add_image_size('tablet-image', Theme_Config::get_breakpoint('tablet'));
    add_image_size('mobile-image', Theme_Config::get_breakpoint('mobile'));
    add_image_size('regular-icon', Theme_Config::get_breakpoint('icon'));
}
