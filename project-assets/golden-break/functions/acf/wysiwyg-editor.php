<?php

// Add custom style formats to TinyMCE
add_filter('tiny_mce_before_init', function ($initArray) {
    $style_formats = [
        [
            'title' => 'Font Weight',
            'items' => [
                ['title' => 'Hairline', 'inline' => 'span', 'styles' => ['font-weight' => '100']],
                ['title' => 'Thin', 'inline' => 'span', 'styles' => ['font-weight' => '200']],
                ['title' => 'Light', 'inline' => 'span', 'styles' => ['font-weight' => '300']],
                ['title' => 'Normal', 'inline' => 'span', 'styles' => ['font-weight' => '400']],
                ['title' => 'Medium', 'inline' => 'span', 'styles' => ['font-weight' => '500']],
                ['title' => 'Semi Bold', 'inline' => 'span', 'styles' => ['font-weight' => '600']],
                ['title' => 'Bold', 'inline' => 'span', 'styles' => ['font-weight' => '700']],
                ['title' => 'Black', 'inline' => 'span', 'styles' => ['font-weight' => '800']],
                ['title' => 'Extra Bold', 'inline' => 'span', 'styles' => ['font-weight' => '900']],
            ]
        ],
        [
            'title' => 'Highlight',
            'inline' => 'mark',
        ],
        [
            'title' => 'Font Sizes',
            'items' => [
                ['title' => 'Extra Large', 'block' => 'span', 'classes' => 'keweb-text--xl'],
                ['title' => 'Large', 'block' => 'span', 'classes' => 'keweb-text--lg'],
                ['title' => 'Medium', 'block' => 'span', 'classes' => 'keweb-text--md'],
                ['title' => 'Small', 'block' => 'span', 'classes' => 'keweb-text--sm'],
                ['title' => 'Extra Small', 'block' => 'span', 'classes' => 'keweb-text--xs'],
                ['title' => 'Extra Extra Small', 'block' => 'span', 'classes' => 'keweb-text--xxs'],
            ]
        ]
    ];

    $initArray['style_formats'] = json_encode($style_formats);

    return $initArray;
});

// Add the styleselect button to the TinyMCE toolbar
add_filter('mce_buttons', function ($buttons) {
    array_push($buttons, 'styleselect');
    return $buttons;
});

add_action('admin_init', function () {
    add_editor_style(get_template_directory_uri() . '/assets/dist/css/editor.style.min.css');
});

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('keweb-editor-styles', get_template_directory_uri() . '/assets/dist/css/editor.style.min.css');
});
