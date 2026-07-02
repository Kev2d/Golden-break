<?php

/**
 * Template Name: Archive Template
 * Description: A custom archive template that displays page content and ACF fields.
 */

get_header();
?>

<?php get_header(); ?>

<main class="layout-xl">

    <section class="archive-header">

        <?php
        if (class_exists('Breadcrumbs')) {
            Breadcrumbs::render();
        }
        ?>

        <?php if (get_field('archive_title')) : ?>
            <h1 class="archive-header__title"><?php echo get_field('archive_title'); ?></h1>
        <?php endif; ?>

        <?php if (get_field('archive_text')) : ?>
            <div class="archive-header__text">
                <?php echo get_field('archive_text'); ?>
            </div>
        <?php endif; ?>
    </section>

    <?php
    while (have_posts()) : the_post();
        the_content();
    endwhile;
    ?>

</main>

<?php get_footer(); ?>