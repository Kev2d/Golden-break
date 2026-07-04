<nav role="navigation" class="site-nav site-nav--desktop" aria-label="<?php _e('Primary navigation', 'golden-break'); ?>">

    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_id'        => 'primary-menu',
        'container'      => false,
        'depth'          => 3,
        'menu_class'     => 'site-nav__menu',
        'fallback_cb'    => 'no_menu_assigned',
        'walker' => new PrimaryNavWalker()
    ));

    function no_menu_assigned()
    {
        echo '<p class="no-menu-message">No menu assigned! Please assign a menu in the WordPress admin panel.</p>';
    }

    ?>

</nav>