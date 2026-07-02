<section class="suggested-posts" aria-labelledby="suggested-posts-title">
    <h4 id="suggested-posts-title" class="suggested-posts__title small--size">
        <?php _e('You might also like', 'keweb'); ?>
    </h4>
    <?php
    // Step 1: Get the current post's categories
    $categories = get_the_category();
    $category_ids = array();
    $post_type = get_post_type();

    if ($categories) {
        foreach ($categories as $category) {
            $category_ids[] = $category->term_id;
        }
    }

    // Step 2: Query for related posts in the same categories
    $args = array(
        'category__in' => $category_ids,
        'post__not_in' => array(get_the_ID()), // Exclude the current post
        'post_type' => $post_type,
        'posts_per_page' => 3,
        'ignore_sticky_posts' => 1,
    );

    $related_posts = new WP_Query($args);
    $related_count = $related_posts->post_count;

    // Step 3: If there are not enough posts, fetch more from other categories
    if ($related_count < 3) {
        $additional_args = array(
            'post__not_in' => array_merge(array(get_the_ID()), wp_list_pluck($related_posts->posts, 'ID')),
            'posts_per_page' => 3 - $related_count,
            'ignore_sticky_posts' => 1,
        );

        $additional_posts = new WP_Query($additional_args);

        // Combine the results
        $all_posts = array_merge($related_posts->posts, $additional_posts->posts);
    } else {
        $all_posts = $related_posts->posts;
    }
    ?>
    <div class="suggested-posts__posts-wrapper custom-swiper-container">

        <?php
        // Generate a unique ID for the slider based on the post ID
        $slider_id = 'content-slider-' . get_the_ID();
        ?>

        <?php get_template_part('template-parts/UI/content-controls', null, array(
            'slider_id' => $slider_id,
        )); ?> <!-- Mobile only -->

        <div id="<?php echo esc_attr($slider_id); ?>" class="suggested-posts__posts custom-swiper-wrapper">
            <?php
            // Step 4: Display the posts
            if (!empty($all_posts)) :
                foreach ($all_posts as $post) :
                    setup_postdata($post);
                    $excerpt = has_excerpt() ? get_the_excerpt() : '';
                    $content = get_the_content();
                    $word_count = str_word_count(strip_tags($content));
                    $read_time = max(1, ceil($word_count / 200));
            ?>
                    <article class="suggested-posts__post custom-swiper-slide">
                        <div>
                            <a href="<?php the_permalink(); ?>" class="suggested-posts__post-link" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php
                                    $thumbnail_id = get_post_thumbnail_id();
                                    $image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
                                    $image_mobile = wp_get_attachment_image_src($thumbnail_id, 'mobile-image');
                                    $image_tablet = wp_get_attachment_image_src($thumbnail_id, 'tablet-image');
                                    $image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                    ?>
                                    <figure>
                                        <picture class="suggested-posts__post-thumbnail">
                                            <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile'); ?>px)" srcset="<?php echo esc_url($image_mobile[0]); ?>">
                                            <source media="(max-width:<?php echo Theme_Config::get_breakpoint('tablet'); ?>px)" srcset="<?php echo esc_url($image_tablet[0]); ?>">
                                            <img
                                                src="<?php echo esc_url($image_full[0]); ?>"
                                                alt="<?php echo esc_attr($image_alt); ?>"
                                                width="<?php echo esc_attr($image_full[1]); ?>"
                                                height="<?php echo esc_attr($image_full[2]); ?>" />
                                        </picture>
                                    </figure>
                                <?php else : ?>
                                    <div class="suggested-posts__post-thumbnail post-no-image"></div>
                                <?php endif; ?>
                                <h5 class="suggested-posts__post-title"><?php the_title(); ?></h5>
                            </a>
                            <p class="suggested-posts__post-excerpt"><?php echo $excerpt; ?></p>
                            <span class="suggested-posts__post-read-time"><?php echo $read_time; ?> <?php _e('min read', 'keweb'); ?></span>
                        </div>
                    </article>
                <?php
                endforeach;
                wp_reset_postdata();
                ?>
        </div>
    </div>
<?php
            endif;
?>
</section>