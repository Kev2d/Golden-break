<?php
function generate_id_from_title($index, $title)
{
    $sanitized_title = sanitize_title_with_dashes($title); // Converts to lowercase and replaces spaces with dashes
    return $index . '_' . $sanitized_title;
}
?>

<section class="text-image-list-block layout-xl">

    <div class="text-image-list-block__top">

        <div class="text-image-list-block__content-wrapper">
            <div class="text-image-list-block__content">
                <?php if (get_field('title')) : ?>
                    <div class="text-image-list-block__content-title">
                        <?php echo get_field('title'); ?>
                    </div>
                <?php endif; ?>

                <?php if (get_field('text')) : ?>
                    <div class="text-image-list-block__content-description">
                        <?php echo get_field('text'); ?>
                    </div>
                <?php endif; ?>

                <?php if (have_rows('content_list')) : ?>

                    <div class="text-image-list-block__table-of-contents">
                        <h4 class="text-image-list-block__table-of-contents-title"><?php _e('Table of Contents', 'golden-break'); ?></h4>
                        <ul class="text-image-list-block__table-of-contents-list">
                            <?php while (have_rows('content_list')) : the_row(); ?>
                                <li class="text-image-list-block__table-of-contents-list-item">
                                    <?php if (get_sub_field('content_title')) : ?>
                                        <a
                                            href="#<?php echo generate_id_from_title(get_row_index(), get_sub_field('content_title')); ?>"
                                            aria-label="<?php echo esc_attr('Go to section ' . get_row_index() . ' titled ' . get_sub_field('content_title')); ?>">
                                            <span class="table-of-contents-number"><?php echo get_row_index(); ?></span>
                                            <?php echo get_sub_field('content_title'); ?>
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

        </div>

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
            <div class="text-image-list-block__image">
                <picture>
                    <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile'); ?>px)" srcset="<?php echo esc_url($image_mobile); ?>">
                    <source media="(max-width:<?php echo Theme_Config::get_breakpoint('tablet'); ?>px)" srcset="<?php echo esc_url($image_tablet); ?>">
                    <img
                        src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>"
                        width="<?php echo esc_attr($image_width); ?>"
                        height="<?php echo esc_attr($image_height); ?>" />
                </picture>
            </div>
        <?php endif; ?>

    </div>

</section>


<?php if (have_rows('content_list')) : ?>
    <section class="text-image-list-block__list-content">
        <?php while (have_rows('content_list')) : the_row(); ?>
            <div class="text-image-list-block__list-content-item" id="<?php echo generate_id_from_title(get_row_index(), get_sub_field('content_title')); ?>">
                <?php if (get_sub_field('content_title')) : ?>
                    <h3 class="text-image-list-block__list-content-item-title">
                        <span class="list-content-number"><?php echo sprintf('%02d', get_row_index());  ?></span>
                        <?php echo get_sub_field('content_title'); ?>
                    </h3>
                <?php endif; ?>
                <?php if (get_sub_field('content')) : ?>
                    <div class="text-image-list-block__list-content-item-text">
                        <?php echo get_sub_field('content'); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </section>
<?php endif; ?>