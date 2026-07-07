<?php
$title = get_field('title');
$description = get_field('description');
$form_shortcode = get_field('form_shortcode');
$bottom_text = get_field('bottom_text');

if (!$title && !$description && !$form_shortcode && !$bottom_text) {
    return;
}
?>

<section class="contact-form-block">
    <div class="contact-form-block__inner layout-xl">
        <article class="contact-form-block__card">
            <?php if ($title || $description) : ?>
                <div class="contact-form-block__header">
                    <?php if ($title) : ?>
                        <div class="contact-form-block__title"><?php echo wp_kses_post($title); ?></div>
                    <?php endif; ?>

                    <?php if ($description) : ?>
                        <div class="contact-form-block__description"><?php echo wp_kses_post($description); ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($form_shortcode) : ?>
                <div class="contact-form-block__form">
                    <?php echo do_shortcode($form_shortcode); ?>
                </div>
            <?php endif; ?>
        </article>

        <?php if ($bottom_text) : ?>
            <div class="contact-form-block__bottom-text"><?php echo wp_kses_post($bottom_text); ?></div>
        <?php endif; ?>
    </div>
</section>
