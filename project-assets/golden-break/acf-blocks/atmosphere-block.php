<?php
$title = get_field('title');
$description = get_field('description');
$bottom_link = get_field('bottom_link');
?>

<section class="atmosphere-block">
    <div class="atmosphere-block__inner layout-xl">
        <?php if ($title || $description) : ?>
            <div class="atmosphere-block__header">
                <?php if ($title) : ?>
                    <div class="atmosphere-block__title">
                        <?php echo wp_kses_post($title); ?>
                    </div>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <div class="atmosphere-block__description">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('images')) : ?>
            <ul class="atmosphere-block__gallery">
                <?php while (have_rows('images')) : the_row();
                    $image = get_sub_field('image');

                    if (!$image) {
                        continue;
                    }

                    $image_url = $image['url'];
                    $image_alt = $image['alt'] ?? '';
                    $image_mobile = $image['sizes']['mobile-image'] ?? $image_url;
                    $image_tablet = $image['sizes']['tablet-image'] ?? $image_url;
                    $image_width = $image['width'] ?? '';
                    $image_height = $image['height'] ?? '';
                ?>
                    <li class="atmosphere-block__gallery-item">
                        <picture>
                            <source media="(max-width:<?php echo esc_attr(Theme_Config::get_breakpoint('mobile')); ?>px)" srcset="<?php echo esc_url($image_mobile); ?>">
                            <source media="(max-width:<?php echo esc_attr(Theme_Config::get_breakpoint('tablet')); ?>px)" srcset="<?php echo esc_url($image_tablet); ?>">
                            <img
                                src="<?php echo esc_url($image_url); ?>"
                                alt="<?php echo esc_attr($image_alt); ?>"
                                width="<?php echo esc_attr($image_width); ?>"
                                height="<?php echo esc_attr($image_height); ?>"
                                loading="lazy" />
                        </picture>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($bottom_link['url'])) :
            $link_url = $bottom_link['url'];
            $link_title = $bottom_link['title'] ?: __('Vaata kõiki pilte', 'golden-break');
            $link_target = $bottom_link['target'] ?: '_self';
        ?>
            <a class="atmosphere-block__link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                <span><?php echo esc_html($link_title); ?></span>
                <?php GetSvg::import('/assets/img/icons/button-arrow-right.svg'); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
