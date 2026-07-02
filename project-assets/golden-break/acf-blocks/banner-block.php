<section class="banner-block layout-xl">
    <?php
    $title_tag = get_field('title_tag');
    if (!$title_tag) {
        $title_tag = 'h2';
    }
    ?>
    <div class="banner-block__content">
        <div>
            <?php if (get_field('title')) : ?>
                <<?php echo esc_html($title_tag); ?> class="title"><?php echo esc_html(get_field('title')); ?></<?php echo esc_html($title_tag); ?>>
            <?php endif; ?>

            <?php if (get_field('text')) : ?>
                <div class="text"> <?php echo get_field('text'); ?></div>
            <?php endif; ?>
        </div>
        <?php
        $link = get_field('button');
        if ($link) :
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
            <a class="banner-block__content-button button--default" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
        <?php endif; ?>

    </div>

    <?php if (get_field('image')) :
        $image = get_field('image');
        $image_url = $image['url'];
        $image_alt = $image['alt'];
        $image_tablet = $image['sizes']['tablet-image'];
        $image_width = $image['width'];
        $image_height = $image['height'];
    ?>

        <picture>
            <source media="(max-width:<?php echo Theme_Config::get_breakpoint('tablet'); ?>px)" srcset="<?php echo esc_url($image_tablet); ?>">
            <img
                class="banner-block-background"
                src="<?php echo esc_url($image_url); ?>"
                alt="<?php echo esc_attr($image_alt); ?>"
                width="<?php echo esc_attr($image_width); ?>"
                height="<?php echo esc_attr($image_height); ?>" />
        </picture>

    <?php endif; ?>

</section>