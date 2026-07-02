<section class="suggested-blocks layout-lg" aria-labelledby="suggested-blocks-title">
    <h4 id="suggested-blocks-title" class="suggested-blocks__title small--size">
        <?php _e('You might also like', 'keweb'); ?>
    </h4>

    <?php
    // Get the current post ID and post type
    $current_post_id = get_the_ID();

    // Only proceed if the current post type is 'blocks'
    // Query for related posts of the 'blocks' post type
    $args = array(
        'post_type' => 'block',
        'post__not_in' => array($current_post_id), // Exclude the current post
        'posts_per_page' => 5,
        'ignore_sticky_posts' => 1,
    );

    $related_posts = new WP_Query($args);

    if ($related_posts->have_posts()) : ?>
        <div class="suggested-blocks__posts">
            <?php while ($related_posts->have_posts()) : $related_posts->the_post();
                $emoji = get_post_meta(get_the_ID(), '_block_emoji', true);
            ?>
                <article class="suggested-blocks__post">
                    <a href="<?php the_permalink(); ?>" class="suggested-blocks__post-link" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                        <?php
                        if (!empty($emoji)) :
                        ?>
                            <span class="block-emoji"><?php echo esc_html($emoji); ?></span>
                        <?php
                        else :
                        ?>
                            <span class="suggested-blocks__post-emoji">🖼️</span>
                        <?php endif; ?>
                        <h5 class="suggested-blocks__post-title"><?php the_title(); ?></h5>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>
    <?php
    endif;

    // Reset post data
    wp_reset_postdata();
    ?>
</section>