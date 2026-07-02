<section class="text-stats-block layout-xl">

    <?php if (get_field('icon')) : $image = get_field('icon'); ?>

        <img class="text-stats-block__icon" width="150" height="150" src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />

    <?php endif; ?>

    <?php $title_tag = get_field('title_tag');
    if (!$title_tag) {
        $title_tag = 'h2';
    }
    ?>
    <?php if (get_field('title')) : ?>
        <<?php echo esc_html($title_tag); ?> class="text-stats-block__title layout-sm"><?php echo esc_html(get_field('title')); ?></<?php echo esc_html($title_tag); ?>>
    <?php endif; ?>


    <?php if (get_field('text')) : ?>
        <div class="text-stats-block__text layout-md"> <?php echo get_field('text'); ?></div>
    <?php endif; ?>

    <?php if (have_rows('stats')) : ?>

        <ul class="text-stats-block__stats">

            <?php while (have_rows('stats')) : the_row(); ?>

                <li class="text-stats-block__stats-statistic">
                    <?php if (get_sub_field('statistical_number')) : ?>
                        <span class="statistic-number"><?php echo get_sub_field('statistical_number'); ?></span>
                    <?php endif; ?>

                    <?php if (get_sub_field('statistical_text')) : ?>
                        <p class="statistic-text"><?php echo get_sub_field('statistical_text'); ?></p>
                    <?php endif; ?>

                </li>
            <?php endwhile; ?>

        </ul>

    <?php endif; ?>

</section>