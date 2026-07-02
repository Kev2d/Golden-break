<section class="icon-text-block layout-sm">

    <?php if (get_field('icon')) : $image = get_field('icon'); ?>

        <picture class="icon-text-block__icon">
            <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile') ?>px)" srcset="<?php echo $image['sizes']['regular-icon']; ?>">
            <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" width="150" height="150" />
        </picture>

    <?php endif; ?>

    <?php $title_tag = get_field('title_tag');
    if (!$title_tag) {
        $title_tag = 'h2';
    }
    ?>
    <div class="icon-text-block__content">
        <div class="icon-text-block__content-title-wrapper">
            <?php if (get_field('icon')) : $image = get_field('icon'); ?>

                <picture class="icon-text-block__content-title-icon">
                    <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile') ?>px)" srcset="<?php echo $image['sizes']['regular-icon']; ?>">
                    <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" width="96" height="96" />
                </picture>

            <?php endif; ?>
            <?php if (get_field('title')) : ?>
                <<?php echo esc_html($title_tag); ?> class="icon-text-block__content-title"><?php echo esc_html(get_field('title')); ?></<?php echo esc_html($title_tag); ?>>
            <?php endif; ?>
        </div>


        <?php if (get_field('text')) : ?>
            <div class="text"> <?php echo get_field('text'); ?></div>
        <?php endif; ?>
        <?php
        $link = get_field('link');
        if ($link) :
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
            <a class="icon-text-block__content-button link--primary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" aria-label="<?php echo esc_html($link_title); ?>"><?php echo esc_html($link_title); ?> <?php GetSvg::import('/assets/img/icons/chevron-right.svg'); ?></a>
        <?php endif; ?>
    </div>


</section>