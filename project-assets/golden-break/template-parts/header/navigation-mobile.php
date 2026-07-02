<nav role="navigation" class="site-nav site-nav--mobile" aria-label="<?php _e('Primary navigation', 'golden-break'); ?>">

    <ul class="site-nav__menu-top">
        <?php get_template_part('template-parts/UI/back-button', null, array(
            'function' => 'close-nav-menu',
            'label' => __('Close navigation', 'golden-break')
        )); ?>

        <?php get_template_part('template-parts/UI/language-menu'); ?>
    </ul>

    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_id'        => 'primary-mobile-menu',
        'container'      => false,
        'depth'          => 3,
        'menu_class'     => 'site-nav__menu',
        'fallback_cb'    => 'no_menu_assigned',
        'walker' => new PrimaryNavWalker(true)
    ));

    ?>

</nav>