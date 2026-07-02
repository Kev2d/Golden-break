<?php

$video_selected = get_field('image_or_video');
$video = get_field('video');
?>

<section class="text-image-block layout-xl">
    <?php
    $title_tag = get_field('title_tag');
    if (!$title_tag) {
        $title_tag = 'h2';
    }
    ?>
    <div class="text-image-block__media<?php echo get_field('media_left_or_right') ? ' left' : ''; ?>">
        <?php if ($video_selected && $video) : ?>

            <video autoplay muted loop playsinline width="<?php echo esc_attr($video['width']); ?>" height="<?php echo esc_attr($video['height']); ?>" loading="lazy">
                <source src="<?php echo esc_url($video['url']); ?>" type="<?php echo esc_attr($video['mime_type']); ?>">
            </video>

        <?php endif; ?>
        <?php
        if (get_field('image') && !$video_selected) :
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
    </div>

    <div class="text-image-block__content">
        <div <?php if (get_field('content_wide')) echo 'class="content-wide"'; ?>>
            <?php if (get_field('title')) : ?>
                <<?php echo esc_html($title_tag); ?>><?php echo esc_html(get_field('title')); ?></<?php echo esc_html($title_tag); ?>>
            <?php endif; ?>
            <?php if (get_field('text')) : ?>
                <div class="text-image-block__content-description">
                    <?php echo get_field('text'); ?>
                </div>
            <?php endif; ?>
            <?php
            $link = get_field('button');
            if ($link) :
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
                <a class="text-image-block__content-button button--secondary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" aria-label="<?php echo esc_attr($link_title); ?>"><?php echo esc_html($link_title); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>