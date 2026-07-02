<section class="features-block layout-xl">
    <?php
    $title_tag = get_field('title_tag');
    if (!$title_tag) {
        $title_tag = 'h2';
    }
    ?>
    <?php if (get_field('title')) : ?>
        <<?php echo esc_html($title_tag); ?> class="features-block__title layout-sm"><?php echo esc_html(get_field('title')); ?></<?php echo esc_html($title_tag); ?>>
    <?php endif; ?>

    <?php if (have_rows('features')) : $count = 1; ?>
        <ul class="features-block__features">
            <?php while (have_rows('features')) : the_row(); ?>
                <li class="features-block__features-feature">
                    <div class="features-block__features-feature-content">
                        <span class="feature-number"><?php echo sprintf('%02d', $count); ?></span>

                        <?php if (get_sub_field('feature_title')) : ?>
                            <h4 class="feature-title"><?php echo get_sub_field('feature_title'); ?></h4>
                        <?php endif; ?>

                        <?php if (get_sub_field('feature_text')) : ?>
                            <?php echo get_sub_field('feature_text'); ?>
                        <?php endif; ?>
                    </div>

                    <?php if (get_sub_field('feature_image')) :
                        $image = get_sub_field('feature_image');
                        $image_url = $image['url'];
                        $is_svg = str_ends_with($image_url, '.svg');
                        $image_alt = $image['alt'] ?? '';

                        if ($is_svg) :
                            $svg_content = SvgRenderer::render($image_url);
                            if ($svg_content) :
                                echo '<div class="feature-image feature-image--svg" aria-hidden="true">' . $svg_content . '</div>';
                            else :
                                echo '<img class="feature-image" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" width="64" height="64">';
                            endif;
                        else :
                            $image_mobile = $image['sizes']['mobile-image'];
                            $image_tablet = $image['sizes']['tablet-image'];
                            $image_large = $image['sizes']['large'];
                            $image_width = $image['sizes']['large-width'];
                            $image_height = $image['sizes']['large-height'];
                    ?>
                            <picture class="feature-image">
                                <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile'); ?>px)" srcset="<?php echo esc_url($image_mobile); ?>">
                                <source media="(max-width:<?php echo Theme_Config::get_breakpoint('tablet'); ?>px)" srcset="<?php echo esc_url($image_tablet); ?>">
                                <img
                                    src="<?php echo esc_url($image_large); ?>"
                                    alt="<?php echo esc_attr($image_alt); ?>"
                                    width="<?php echo esc_attr($image_width); ?>"
                                    height="<?php echo esc_attr($image_height); ?>">
                            </picture>
                    <?php endif;
                    endif; ?>

                </li>
            <?php $count++;
            endwhile; ?>
        </ul>
    <?php endif; ?>
</section>