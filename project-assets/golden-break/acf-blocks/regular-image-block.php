<section class="regular-image-block layout-xl">
    <?php
    if (get_field('image')) :
        $image = get_field('image');
        $image_url = $image['url'];
        $image_alt = $image['alt'];
        $image_mobile = $image['sizes']['mobile-image'];
        $image_tablet = $image['sizes']['tablet-image'];
        $image_width = $image['width'];
        $image_height = $image['height'];
    ?>

        <picture>
            <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile'); ?>px)" srcset="<?php echo esc_url($image_mobile); ?>">
            <source media="(max-width:<?php echo Theme_Config::get_breakpoint('tablet'); ?>px)" srcset="<?php echo esc_url($image_tablet); ?>">
            <img
                src="<?php echo esc_url($image_url); ?>"
                alt="<?php echo esc_attr($image_alt); ?>"
                width="<?php echo esc_attr($image_width); ?>"
                height="<?php echo esc_attr($image_height); ?>" />
        </picture>

    <?php endif; ?>
</section>