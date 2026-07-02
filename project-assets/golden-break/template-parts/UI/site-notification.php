<?php
$theme_description = get_option('custom_theme_description', '');

if (!empty($theme_description)): ?>
    <section class="theme-notification layout-xl" role="note">
        <p><?php echo wp_kses_post($theme_description); ?></p>
    </section>
<?php endif; ?>