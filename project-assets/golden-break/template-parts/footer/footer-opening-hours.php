<?php
$title = get_field('footer_opening_hours_title', 'option');
$hours = get_field('footer_opening_hours', 'option');
?>

<?php if ($title || $hours || have_rows('footer_social_media_icons', 'option')) : ?>
    <div class="footer-links__column footer-links__column--opening-hours">
        <?php if ($title) : ?>
            <p class="footer-links__column-title"><?php echo esc_html($title); ?></p>
        <?php endif; ?>

        <?php if ($hours) : ?>
            <div class="footer-links__opening-hours">
                <?php echo wp_kses_post($hours); ?>
            </div>
        <?php endif; ?>

        <?php get_template_part('template-parts/footer/footer-social'); ?>
    </div>
<?php endif; ?>
