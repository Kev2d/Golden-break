<section class="posts-display-block">
    <?php
    $title_tag = get_field('title_tag');
    if (!$title_tag) {
        $title_tag = 'h2';
    }
    ?>
    <?php if (get_field('title')) : ?>
        <<?php echo esc_html($title_tag); ?> class="posts-display-block-title small--size"><?php echo esc_html(get_field('title')); ?></<?php echo esc_html($title_tag); ?>>
    <?php endif; ?>

    <div class="posts-display-block__wrapper custom-swiper-container">

        <?php
        $post_type = get_field('select_post_type');
        $selected_posts = get_field('selected_posts');
        $slider_id = 'content-slider-' . substr(uniqid(), -5); // Unique slider ID
        ?>

        <?php get_template_part('template-parts/UI/content-controls', null, array(
            'slider_id' => $slider_id,
        )); ?> <!-- Mobile only -->

        <div id="<?php echo esc_attr($slider_id); ?>" class="posts-display-block__posts custom-swiper-wrapper">
            <?php
            if ($selected_posts || $post_type) {
                if ($selected_posts) {
                    $args = array(
                        'post_type' => 'any',
                        'post__in' => $selected_posts,
                        'orderby' => 'post__in',
                        'posts_per_page' => count($selected_posts),
                    );
                } elseif ($post_type) {
                    $args = array(
                        'post_type' => $post_type,
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC',
                    );
                }

                // Query the posts
                $latest_posts = new WP_Query($args);

                // Start the loop if we have posts
                if ($latest_posts->have_posts()) :
                    while ($latest_posts->have_posts()) : $latest_posts->the_post();
                        $content = get_the_content();
                        $word_count = str_word_count(strip_tags($content));
                        $excerpt = has_excerpt() ? get_the_excerpt() : '';
                        $read_time = max(1, ceil($word_count / 200)); // Calculate read time

                        // Get thumbnail data
                        if (has_post_thumbnail()):
                            $thumbnail_id = get_post_thumbnail_id();
                            $image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
                            $image_mobile = wp_get_attachment_image_src($thumbnail_id, 'mobile-image');
                            $image_tablet = wp_get_attachment_image_src($thumbnail_id, 'tablet-image');
                            $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                        endif;
            ?>
                        <div class="posts-display-block__post custom-swiper-slide">
                            <article>
                                <a class="posts-display-block__post-link" href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="posts-display-block__post-thumbnail">
                                            <picture>
                                                <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile'); ?>px)" srcset="<?php echo esc_url($image_mobile[0]); ?>">
                                                <source media="(max-width:<?php echo Theme_Config::get_breakpoint('tablet'); ?>px)" srcset="<?php echo esc_url($image_tablet[0]); ?>">
                                                <img
                                                    src="<?php echo esc_url($image_mobile[0]); ?>"
                                                    alt="<?php echo esc_attr($thumbnail_alt); ?>"
                                                    width="<?php echo esc_attr($image_mobile[1]); ?>"
                                                    height="<?php echo esc_attr($image_mobile[2]); ?>" />
                                            </picture>
                                        </div>
                                    <?php endif; ?>

                                    <h4 class="posts-display-block__post-title"><?php the_title(); ?></h4>
                                </a>

                                <?php if ($excerpt) : ?>
                                    <p class="posts-display-block__post-excerpt"><?php echo $excerpt; ?></p>
                                <?php endif; ?>

                                <?php if (get_post_type() !== 'portfolio') : ?>
                                    <span class="posts-display-block__post-read-time"><?php echo $read_time; ?> <?php _e('min read', 'keweb'); ?></span>
                                <?php endif; ?>
                            </article>
                        </div>
            <?php
                    endwhile; // End of the loop
                endif;

                wp_reset_postdata(); // Reset query data after loop

            }
            ?>
        </div>
    </div>
</section>