<?php
$title = get_field('title');
$layout = get_field('layout') ?: 'list';
$description = get_field('description');
$icon = get_field('icon');

$default_icon = '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><path d="M12 21s7-5.2 7-12a7 7 0 0 0-14 0c0 6.8 7 12 7 12Z"></path><circle cx="12" cy="9" r="2.5"></circle></svg>';

if (!$title && !$description && !have_rows('items')) {
    return;
}
?>

<section class="info-note-block info-note-block--<?php echo esc_attr($layout); ?>">
    <div class="info-note-block__inner layout-xl">
        <article class="info-note-block__card">
            <?php if ('centered' === $layout && ($icon || $default_icon)): ?>
                <div class="info-note-block__icon" aria-hidden="true">
                    <?php if ($icon):
                        $icon_url = $icon['url'] ?? '';
                        $icon_alt = $icon['alt'] ?? '';
                        ?>
                        <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>" width="24" height="24">
                    <?php else: ?>
                        <?php echo $default_icon; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($title): ?>
                <div class="info-note-block__title"><?php echo wp_kses_post($title); ?></div>
            <?php endif; ?>

            <?php if ($description): ?>
                <div class="info-note-block__description"><?php echo wp_kses_post($description); ?></div>
            <?php endif; ?>

            <?php if ('list' === $layout && have_rows('items')): ?>
                <ul class="info-note-block__list">
                    <?php while (have_rows('items')): the_row();
                        $item = get_sub_field('item');
                        if (!$item) {
                            continue;
                        }
                        ?>
                        <li class="info-note-block__list-item"><?php echo esc_html($item); ?></li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </article>
    </div>
</section>
