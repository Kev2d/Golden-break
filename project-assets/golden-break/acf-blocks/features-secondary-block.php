<div class="features-block layout-lg">
    <?php if (get_field('title')) : ?>
        <h3 class="main-title"><?php echo esc_html(get_field('title')); ?></h3>
    <?php endif; ?>
    
    <div class="features-block__repeater <?php echo get_field('block_wide') ? 'wide' : '' ?>">
        <?php if (have_rows('features')) :
            while (have_rows('features')) : the_row(); ?>
                <div>
                    <?php
                    $image = get_sub_field('feature_image');
                    if ($image) :
                        $attachment_id = $image['ID'];
                        $metadata = wp_get_attachment_metadata($attachment_id);
                        $width = $metadata['width'] ?? '';
                        $height = $metadata['height'] ?? '';
                        ?>
                        <picture>
                            <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile'); ?>px)" srcset="<?php echo esc_url($image['sizes']['regular-icon']); ?>">
                            <img src="<?php echo esc_url($image['sizes']['mobile-image']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" />
                        </picture>
                    <?php endif; ?>

                    <?php if (get_sub_field('feature_title')) : ?>
                        <h5 class="title"><?php echo esc_html(get_sub_field('feature_title')); ?></h5>
                    <?php endif; ?>

                    <?php if (get_sub_field('feature_text')) : ?>
                        <div class="text"><?php echo get_sub_field('feature_text'); ?></div>
                    <?php endif; ?>
                </div>
        <?php endwhile; endif; ?>
    </div>
</div>
