<ul class="settings-menu common-menu">
    <li class="settings">
        <button class="settings__toggle common-menu__toggle" aria-haspopup="true" aria-expanded="false" aria-label="<?php _e('Open settings menu', 'golden-break'); ?>">
            <?php GetSvg::import('/assets/img/icons/dots-vertical.svg'); ?>
        </button>
        <ul class=" settings__menu common-menu__menu" aria-hidden="true" inert>
            <li class="list-back-button">
                <?php get_template_part('template-parts/UI/back-button', null, array(
                    'function' => 'settings-menu-back',
                    'label' => __('Go back', 'golden-break')
                )); ?>
            </li>
            <li>
                <button data-theme-button="light" class="theme-button<?php echo ThemeManager::getTheme() === 'light' ? ' active' : ''; ?>">
                    <?php GetSvg::import('/assets/img/icons/light-mode.svg'); ?>
                    <?php _e('Light Theme', 'golden-break'); ?>
                </button>
            </li>
            <li>
                <button data-theme-button="dark" class="theme-button<?php echo ThemeManager::getTheme() === 'dark' ? ' active' : ''; ?>">
                    <?php GetSvg::import('/assets/img/icons/dark-mode.svg'); ?>
                    <?php _e('Dark Theme', 'golden-break'); ?>
                </button>
            </li>
            <!--   <li>
                <button data-notification-action="hide">
                    <?php GetSvg::import('/assets/img/icons/alert.svg'); ?>
                    <?php _e('Hide Notifications', 'golden-break'); ?>
                </button>
            </li> -->
        </ul>
    </li>
</ul>