<nav role="navigation" class="site-nav site-nav--mobile" aria-label="<?php _e('Primary navigation', 'golden-break'); ?>">

    <div class="site-nav-mobile__panel">
        <div class="site-nav-mobile__content">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-mobile-menu',
                'container'      => false,
                'depth'          => 1,
                'menu_class'     => 'site-nav__menu',
                'fallback_cb'    => 'no_menu_assigned',
                'walker' => new PrimaryNavWalker(true)
            ));
            ?>

            <div class="site-nav-mobile__cta">
                <?php get_template_part('template-parts/header/booking-cta'); ?>
            </div>
        </div>
    </div>

</nav>
