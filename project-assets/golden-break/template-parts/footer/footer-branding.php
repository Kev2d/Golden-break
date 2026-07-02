<div class="footer-branding">
    <div>
        <?php
        $footer_logo = get_field('footer_logo', 'option');
        $footer_logo_dark = get_field('footer_logo_dark', 'option');

        if ($footer_logo) :
            $footer_logo_width = $footer_logo['width'] > 0 ? $footer_logo['width'] : 200; // Default fallback width
            $footer_logo_height = $footer_logo['height'] > 0 ? $footer_logo['height'] : 42; // Default fallback height
        ?>
            <img
                class="footer-branding__logo"
                src="<?php echo esc_url($footer_logo['sizes']['medium']); ?>"
                alt="<?php echo esc_attr($footer_logo['alt']); ?>"
                <?php echo $footer_logo_dark ? 'data-element="light"' : ''; ?>
                width="<?php echo esc_attr($footer_logo_width); ?>"
                height="<?php echo esc_attr($footer_logo_height); ?>" />
        <?php endif; ?>

        <?php
        if ($footer_logo_dark) :
            $footer_logo_dark_width = $footer_logo_dark['width'] > 0 ? $footer_logo_dark['width'] : 100; // Default fallback width
            $footer_logo_dark_height = $footer_logo_dark['height'] > 0 ? $footer_logo_dark['height'] : 100; // Default fallback height
        ?>
            <img
                class="footer-branding__logo"
                src="<?php echo esc_url($footer_logo_dark['sizes']['medium']); ?>"
                alt="<?php echo esc_attr($footer_logo_dark['alt']); ?>"
                <?php echo $footer_logo ? 'data-element="dark"' : ''; ?>
                width="<?php echo esc_attr($footer_logo_dark_width); ?>"
                height="<?php echo esc_attr($footer_logo_dark_height); ?>" />
        <?php endif; ?>

        <?php if (get_field('footer_tagline', 'option')) : ?>
            <div class="footer-branding__tagline">
                <?php echo get_field('footer_tagline', 'option'); ?>
            </div>
        <?php endif; ?>
    </div>
    <?php get_template_part('template-parts/footer/footer-social'); ?>
</div>