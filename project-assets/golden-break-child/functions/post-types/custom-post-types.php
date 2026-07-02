<?php
/**
 * Register the custom post type for FAQs.
 */
function register_faq_post_type()
{
    $post_type_labels = array(
        'name'                  => __('FAQs'),
        'singular_name'         => __('FAQ'),
        'menu_name'             => __('FAQs'),
        'name_admin_bar'        => __('FAQ'),
        'add_new'               => __('Add New'),
        'add_new_item'          => __('Add New FAQ'),
        'new_item'              => __('New FAQ'),
        'edit_item'             => __('Edit FAQ'),
        'view_item'             => __('View FAQ'),
        'all_items'             => __('All FAQs'),
        'search_items'          => __('Search FAQs'),
        'not_found'             => __('No FAQs found.'),
        'not_found_in_trash'    => __('No FAQs found in Trash.'),
        'featured_image'        => __('FAQ Image'),
        'set_featured_image'    => __('Set FAQ image'),
        'remove_featured_image' => __('Remove FAQ image'),
        'use_featured_image'    => __('Use as FAQ image'),
    );

    $post_type_args = array(
        'labels'             => $post_type_labels,
        'hierarchical'       => false,
        'public'             => true,
        'has_archive'        => false,
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'show_in_rest'       => true, // Enable for Gutenberg editor
        'rewrite'            => array('slug' => 'faqs'),
        'taxonomies'         => array('faq_categories'),
        'supports'           => array('title', 'editor', 'thumbnail', 'author', 'revisions', 'excerpt'),
    );

    register_post_type('faq', $post_type_args);
}

add_action('init', 'register_faq_post_type');

/**
 * Register the custom taxonomy for FAQ Categories.
 */
function register_faq_taxonomy()
{
    $taxonomy_labels = array(
        'name'                       => __('FAQ Categories'),
        'singular_name'              => __('FAQ Category'),
        'search_items'               => __('Search FAQ Categories'),
        'all_items'                  => __('All FAQ Categories'),
        'parent_item'                => __('Parent FAQ Category'),
        'parent_item_colon'          => __('Parent FAQ Category:'),
        'edit_item'                  => __('Edit FAQ Category'),
        'update_item'                => __('Update FAQ Category'),
        'add_new_item'               => __('Add New FAQ Category'),
        'new_item_name'              => __('New FAQ Category Name'),
        'menu_name'                  => __('FAQ Categories'),
    );

    $taxonomy_args = array(
        'hierarchical'      => true,
        'labels'            => $taxonomy_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true, // Enable for Gutenberg editor
        'query_var'         => true,
        'rewrite'           => array('slug' => 'faq-categories'),
    );

    register_taxonomy('faq_categories', array('faq'), $taxonomy_args);
    register_taxonomy_for_object_type('faq_categories', 'faq');
}

add_action('init', 'register_faq_taxonomy');

/**
 * Register the custom post type for Blocks.
 */
function register_block_post_type()
{
    $post_type_labels = array(
        'name'                  => __('Blocks'),
        'singular_name'         => __('Block'),
        'menu_name'             => __('Blocks'),
        'name_admin_bar'        => __('Block'),
        'add_new'               => __('Add New'),
        'add_new_item'          => __('Add New Block'),
        'new_item'              => __('New Block'),
        'edit_item'             => __('Edit Block'),
        'view_item'             => __('View Block'),
        'all_items'             => __('All Blocks'),
        'search_items'          => __('Search Blocks'),
        'not_found'             => __('No Blocks found.'),
        'not_found_in_trash'    => __('No Blocks found in Trash.'),
        'featured_image'        => __('Block Image'),
        'set_featured_image'    => __('Set Block image'),
        'remove_featured_image' => __('Remove Block image'),
        'use_featured_image'    => __('Use as Block image'),
    );

    $post_type_args = array(
        'labels'             => $post_type_labels,
        'hierarchical'       => false,
        'public'             => true,
        'has_archive'        => false,
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'show_in_rest'       => true, // Enable for Gutenberg editor
        'rewrite'            => array('slug' => 'blocks'),
        'supports'           => array('title', 'editor', 'thumbnail', 'author', 'revisions', 'excerpt'),
    );

    register_post_type('block', $post_type_args);
}

add_action('init', 'register_block_post_type');

/**
 * Register the custom taxonomy for Block Categories.
 */
function register_block_taxonomy()
{
    $taxonomy_labels = array(
        'name'                       => __('Block Categories'),
        'singular_name'              => __('Block Category'),
        'search_items'               => __('Search Block Categories'),
        'all_items'                  => __('All Block Categories'),
        'parent_item'                => __('Parent Block Category'),
        'parent_item_colon'          => __('Parent Block Category:'),
        'edit_item'                  => __('Edit Block Category'),
        'update_item'                => __('Update Block Category'),
        'add_new_item'               => __('Add New Block Category'),
        'new_item_name'              => __('New Block Category Name'),
        'menu_name'                  => __('Block Categories'),
    );

    $taxonomy_args = array(
        'hierarchical'      => true,
        'labels'            => $taxonomy_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true, // Enable for Gutenberg editor
        'query_var'         => true,
        'rewrite'           => array('slug' => 'block-categories'),
    );

    register_taxonomy('block_categories', array('block'), $taxonomy_args);
    register_taxonomy_for_object_type('block_categories', 'block');
}

add_action('init', 'register_block_taxonomy');

