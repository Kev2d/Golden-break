<?php
$title = get_field('title');
$description = get_field('description');
$images = get_field('images');

if (!$title && !$description && empty($images)) {
    return;
}
?>

<section class="gallery-block">
    <div class="gallery-block__inner layout-xl">
        <?php if ($title || $description) : ?>
            <div class="gallery-block__header">
                <?php if ($title) : ?>
                    <div class="gallery-block__title"><?php echo wp_kses_post($title); ?></div>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <div class="gallery-block__description"><?php echo wp_kses_post($description); ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($images)) : ?>
            <ul class="gallery-block__grid">
                <?php foreach ($images as $image) :
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
                    <li class="gallery-block__item">
                        <button
                            class="gallery-block__trigger"
                            type="button"
                            data-gallery-lightbox-trigger
                            data-gallery-src="<?php echo esc_url($image_url); ?>"
                            data-gallery-alt="<?php echo esc_attr($image_alt); ?>">
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
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>
