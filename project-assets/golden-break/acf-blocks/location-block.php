<?php
$title = get_field('title');
$description = get_field('description');
$link = get_field('link');
$map_embed = trim((string) get_field('map_embed'));
$map_src = '';

if ($map_embed) {
    if (preg_match('/src=["\']([^"\']+)["\']/i', $map_embed, $matches)) {
        $map_src = html_entity_decode($matches[1]);
    } else {
        $map_src = $map_embed;
    }
}

$map_host = $map_src ? parse_url($map_src, PHP_URL_HOST) : '';
$is_google_map = $map_host && false !== strpos($map_host, 'google.') && false !== strpos($map_src, '/maps');
$default_icons = [
    '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><path d="M12 21s7-5.2 7-12a7 7 0 0 0-14 0c0 6.8 7 12 7 12Z"></path><circle cx="12" cy="9" r="2.5"></circle></svg>',
    '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><path d="M16 21v-2a4 4 0 0 0-8 0v2"></path><circle cx="12" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
    '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><path d="M8 21h8"></path><path d="M12 17v4"></path><path d="M7 4h10v4a5 5 0 0 1-10 0V4Z"></path><path d="M17 5h3a2 2 0 0 1-2 5h-1"></path><path d="M7 5H4a2 2 0 0 0 2 5h1"></path></svg>',
];
?>

<section class="location-block">
    <div class="location-block__inner layout-xl">
        <?php if ($title || $description) : ?>
            <div class="location-block__header">
                <?php if ($title) : ?>
                    <div class="location-block__title">
                        <?php echo wp_kses_post($title); ?>
                    </div>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <div class="location-block__description">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="location-block__body">
            <div class="location-block__content">
                <?php if (have_rows('items')) : ?>
                    <ul class="location-block__items">
                        <?php while (have_rows('items')) : the_row();
                            $icon = get_sub_field('icon');
                            $item_title = get_sub_field('item_title');
                            $item_text = get_sub_field('item_text');
                        ?>
                            <li class="location-block__item">
                                <div class="location-block__item-icon" aria-hidden="true">
                                    <?php if ($icon) :
                                        $icon_url = $icon['url'];
                                        $icon_alt = $icon['alt'] ?? '';
                                    ?>
                                        <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>" width="20" height="20">
                                    <?php else : ?>
                                        <?php echo $default_icons[get_row_index() - 1] ?? $default_icons[0]; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="location-block__item-content">
                                    <?php if ($item_title) : ?>
                                        <p class="location-block__item-title"><?php echo esc_html($item_title); ?></p>
                                    <?php endif; ?>

                                    <?php if ($item_text) : ?>
                                        <div class="location-block__item-text"><?php echo wp_kses_post($item_text); ?></div>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>

                <?php if (!empty($link['url'])) :
                    $link_url = $link['url'];
                    $link_title = $link['title'] ?: __('Võta ühendust', 'golden-break');
                    $link_target = $link['target'] ?: '_self';
                ?>
                    <a class="location-block__link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                        <span><?php echo esc_html($link_title); ?></span>
                        <?php GetSvg::import('/assets/img/icons/button-arrow-right.svg'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php if ($is_google_map) : ?>
                <div class="location-block__map">
                    <iframe
                        src="<?php echo esc_url($map_src); ?>"
                        title="<?php echo esc_attr__('Golden Break location map', 'golden-break'); ?>"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen></iframe>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
