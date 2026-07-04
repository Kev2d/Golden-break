<?php
$title = get_field('title');
$text = get_field('text');
?>

<section class="title-text-block">
    <div class="title-text-block__inner layout-md">
        <?php if ($title) : ?>
            <div class="title-text-block__title"><?php echo wp_kses_post($title); ?></div>
        <?php endif; ?>

        <?php if ($text) : ?>
            <div class="title-text-block__text"><?php echo wp_kses_post($text); ?></div>
        <?php endif; ?>
    </div>

</section>
