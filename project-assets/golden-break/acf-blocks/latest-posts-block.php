<section class="latest-posts-block">
    <div class="latest-posts-block__wrapper custom-swiper-container">

        <?php
        $slider_id = 'content-slider-' . substr(uniqid(), -5);
        ?>

        <?php get_template_part('template-parts/UI/content-controls', null, array(
            'slider_id' => $slider_id,
        )); ?>

        <div id="<?php echo esc_attr($slider_id); ?>" class="latest-posts-block__articles custom-swiper-wrapper">
            <?php $post_ids = get_field('select_taxonomy');
            if ($post_ids): ?>
                <?php foreach ($post_ids as $post_id): ?>
                    <?php if (has_post_thumbnail($post_id)):
                        // Get the thumbnail details
                        $thumbnail_id = get_post_thumbnail_id($post_id);
                        $image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
                        $image_mobile = wp_get_attachment_image_src($thumbnail_id, 'mobile-image');
                        $image_tablet = wp_get_attachment_image_src($thumbnail_id, 'tablet-image');
                        $image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                    ?>
                        <div class="latest-posts-block__articles-post custom-swiper-slide">
                            <article>
                                <a class="latest-posts-block__articles-post-link" href="<?php echo get_permalink($post_id); ?>">
                                    <picture>
                                        <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile'); ?>px)" srcset="<?php echo esc_url($image_mobile[0]); ?>">
                                        <source media="(max-width:<?php echo Theme_Config::get_breakpoint('tablet'); ?>px)" srcset="<?php echo esc_url($image_tablet[0]); ?>">
                                        <img
                                            class="latest-posts-block__articles-post-thumbnail"
                                            src="<?php echo esc_url($image_tablet[0]); ?>"
                                            alt="<?php echo esc_attr($image_alt); ?>"
                                            width="<?php echo esc_attr($image_tablet[1]); ?>"
                                            height="<?php echo esc_attr($image_tablet[2]); ?>" />
                                    </picture>

                                    <div class="latest-posts-block__articles-post-content">
                                        <h4 class="latest-posts-block__articles-post-content-title"><?php echo get_the_title($post_id); ?></h4>

                                        <time class="latest-posts-block__articles-post-content-date" datetime="<?php echo get_the_date('Y-m-d', $post_id); ?>">
                                            <?php echo get_the_date('d M Y', $post_id); ?>
                                        </time>
                                    </div>
                                </a>
                            </article>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>