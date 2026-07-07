<?php
$title = get_field('title');

if (!$title && !have_rows('stats')) {
    return;
}
?>

<section class="stats-strip-block">
    <div class="stats-strip-block__inner layout-xl">
        <article class="stats-strip-block__card">
            <?php if ($title): ?>
                <div class="stats-strip-block__title"><?php echo wp_kses_post($title); ?></div>
            <?php endif; ?>

            <?php if (have_rows('stats')): ?>
                <ul class="stats-strip-block__list">
                    <?php while (have_rows('stats')): the_row();
                        $value = get_sub_field('value');
                        $label = get_sub_field('label');

                        if (!$value && !$label) {
                            continue;
                        }
                        ?>
                        <li class="stats-strip-block__item">
                            <?php if ($value): ?>
                                <span class="stats-strip-block__value"><?php echo esc_html($value); ?></span>
                            <?php endif; ?>

                            <?php if ($label): ?>
                                <span class="stats-strip-block__label"><?php echo esc_html($label); ?></span>
                            <?php endif; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </article>
    </div>
</section>
