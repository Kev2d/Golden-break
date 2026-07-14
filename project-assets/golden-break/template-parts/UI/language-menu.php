<?php
// Fetch the languages
$languages = function_exists('icl_get_languages') ? icl_get_languages('skip_missing=1&orderby=code') : array();

if (!empty($languages) && count($languages) > 1) :
    // Find the active language
    $current_language = null;
    foreach ($languages as $lang) {
        if ($lang['active']) {
            $current_language = $lang;
            break;
        }
    }

    $current_language = $current_language ?: reset($languages);
    $current_language_code = strtoupper($current_language['language_code'] ?? '');
?>

    <nav aria-label="<?php _e('Language menu', 'golden-break'); ?>">
        <ul class="language-menu common-menu">
            <li class="language">
                <button class="language__toggle common-menu__toggle" aria-haspopup="true" aria-expanded="false">
                    <span aria-label="<?php echo esc_attr($current_language['native_name']); ?>">
                        <?php echo esc_html($current_language_code); ?>
                    </span>
                    <?php GetSvg::import('/assets/img/icons/chevron-down.svg'); ?>
                </button>
                <ul class="language__menu common-menu__menu" aria-hidden="true">
                    <li class="list-back-button">
                        <?php
                        get_template_part('template-parts/UI/back-button', null, array(
                            'function' => 'close-language-menu',
                            'label' => __('Back to previous menu', 'golden-break')
                        ));
                        ?>
                    </li>
                    <?php foreach ($languages as $lang) : ?>
                        <li>
                            <a
                                class="language-switcher-item<?php echo $lang['active'] ? ' active' : ''; ?>"
                                href="<?php echo esc_url($lang['url']); ?>"
                                hreflang="<?php echo esc_attr($lang['language_code']); ?>"
                                lang="<?php echo esc_attr($lang['language_code']); ?>"
                                aria-label="<?php echo esc_attr($lang['native_name']); ?>"
                                <?php echo $lang['active'] ? 'aria-current="page"' : ''; ?>
                            >
                                <?php echo esc_html($lang['native_name']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </nav>
<?php endif; ?>
