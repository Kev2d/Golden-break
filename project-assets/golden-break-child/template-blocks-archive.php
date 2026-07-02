<?php

/**
 * Template Name: Blocks Archive Template
 * Description: A custom archive template that displays page content and ACF fields.
 */

get_header();
?>

<?php get_header(); ?>

<main class="layout-xl">

    <?php
    while (have_posts()) : the_post();
        the_content();
    endwhile;
    ?>

    <section class="blocks-archive">
        <?php
        // Query to get all custom post type 'block'
        $args = array(
            'post_type' => 'block',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        );
        $related_posts = new WP_Query($args);

        if ($related_posts->have_posts()) :
            while ($related_posts->have_posts()) : $related_posts->the_post();
                // Fetch custom emoji meta
                $emoji = get_post_meta(get_the_ID(), '_block_emoji', true);
        ?>
                <article class="blocks-archive__block">
                    <a href="<?php the_permalink(); ?>" class="blocks-archive__block-link">
                        <span class="blocks-archive__block-emoji">
                            <?php echo !empty($emoji) ? esc_html($emoji) : '🖼️'; ?>
                        </span>
                        <h4 class="blocks-archive__block-title"><?php the_title(); ?></h4>
                    </a>
                </article>
        <?php
            endwhile;
        endif;

        // Reset post data after custom query
        wp_reset_postdata();
        ?>
    </section>

</main>

<?php get_footer(); ?>