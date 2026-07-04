<?php
$address = get_field('address');
$title = get_field('title');
$description = get_field('description');
$button = get_field('button');
$fallback_button = function_exists('get_field') ? get_field('booking_button', 'option') : null;
$slides = [];

if (have_rows('background_slides')) {
    while (have_rows('background_slides')) {
        the_row();
        $background_slide = get_sub_field('background_slide');

        if ($background_slide) {
            $slides[] = $background_slide;
        }
    }
}

if (!$button && $fallback_button) {
    $button = $fallback_button;
}
?>

<section class="hero-block">
    <?php if ($slides) : ?>
        <div class="hero-block__background swiper" data-hero-slider>
            <div class="hero-block__slides swiper-wrapper">
                <?php foreach ($slides as $index => $slide) : ?>
                    <div class="hero-block__slide swiper-slide">
                        <picture>
                            <?php if (!empty($slide['sizes']['mobile-image'])) : ?>
                                <source media="(max-width:<?php echo esc_attr(Theme_Config::get_breakpoint('mobile')); ?>px)" srcset="<?php echo esc_url($slide['sizes']['mobile-image']); ?>">
                            <?php endif; ?>

                            <?php if (!empty($slide['sizes']['tablet-image'])) : ?>
                                <source media="(max-width:<?php echo esc_attr(Theme_Config::get_breakpoint('tablet')); ?>px)" srcset="<?php echo esc_url($slide['sizes']['tablet-image']); ?>">
                            <?php endif; ?>

                            <img
                                loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>"
                                src="<?php echo esc_url($slide['url']); ?>"
                                alt="<?php echo esc_attr($slide['alt']); ?>"
                                width="<?php echo esc_attr($slide['width']); ?>"
                                height="<?php echo esc_attr($slide['height']); ?>"
                            />
                        </picture>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="hero-block__overlay"></div>

    <div class="hero-block__inner layout-xl">
        <div class="hero-block__content">
            <?php if ($address) : ?>
                <div class="hero-block__address">
                    <svg aria-hidden="true" viewBox="0 0 24 24" focusable="false">
                        <path d="M12 21s7-5.2 7-12a7 7 0 0 0-14 0c0 6.8 7 12 7 12Z"></path>
                        <circle cx="12" cy="9" r="2.5"></circle>
                    </svg>
                    <span><?php echo esc_html($address); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($title) : ?>
                <div class="hero-block__content-title">
                    <?php echo wp_kses_post($title); ?>
                </div>
            <?php endif; ?>

            <?php if ($description) : ?>
                <div class="hero-block__content-description">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($button['url'])) :
                $link_url = $button['url'];
                $link_title = $button['title'] ?: __('Broneeri laud', 'golden-break');
                $link_target = $button['target'] ?: '_self';
            ?>
                <a class="hero-block__button" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                    <svg aria-hidden="true" viewBox="0 0 24 24" focusable="false">
                        <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                        <path d="M16 3v4M8 3v4M3 11h18"></path>
                    </svg>
                    <span><?php echo esc_html($link_title); ?></span>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (count($slides) > 1) : ?>
        <div class="hero-block__pagination hero-block-pagination"></div>
    <?php endif; ?>
</section>
