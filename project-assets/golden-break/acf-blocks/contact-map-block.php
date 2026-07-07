<?php
$details_title = get_field('details_title');
$social_title = get_field('social_title');
$directions_title = get_field('directions_title');
$map_embed = trim((string) get_field('map_embed'));
$map_src = '';

if ($map_embed) {
    if (preg_match('/src=["\']([^"\']+)["\']/i', $map_embed, $matches)) {
        $map_src = html_entity_decode($matches[1]);
    } else {
        $map_src = $map_embed;
    }
}

$default_icons = [
    'address' => '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><path d="M12 21s7-5.2 7-12a7 7 0 0 0-14 0c0 6.8 7 12 7 12Z"></path><circle cx="12" cy="9" r="2.5"></circle></svg>',
    'hours' => '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg>',
    'phone' => '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.2 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.35 1.89.66 2.78a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.3-1.23a2 2 0 0 1 2.11-.45c.89.31 1.82.53 2.78.66A2 2 0 0 1 22 16.92Z"></path></svg>',
    'email' => '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><rect width="18" height="14" x="3" y="5" rx="2"></rect><path d="m3 7 9 6 9-6"></path></svg>',
];

$render_icon = static function ($icon, $fallback_svg) {
    if ($icon) {
        $icon_url = $icon['url'] ?? '';
        $icon_alt = $icon['alt'] ?? '';

        if ($icon_url) {
            echo '<img src="' . esc_url($icon_url) . '" alt="' . esc_attr($icon_alt) . '" width="20" height="20">';
            return;
        }
    }

    echo $fallback_svg;
};
?>

<section class="contact-map-block">
    <div class="contact-map-block__inner layout-xl">
        <div class="contact-map-block__body">
            <div class="contact-map-block__cards">
                <?php if ($details_title || have_rows('details_items') || have_rows('social_links')) : ?>
                    <article class="contact-map-block__card">
                        <?php if ($details_title) : ?>
                            <div class="contact-map-block__card-title">
                                <?php echo wp_kses_post($details_title); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (have_rows('details_items')) : ?>
                            <ul class="contact-map-block__details">
                                <?php while (have_rows('details_items')) : the_row();
                                    $icon = get_sub_field('icon');
                                    $icon_type = get_sub_field('icon_type') ?: 'address';
                                    $item_title = get_sub_field('item_title');
                                    $item_text = get_sub_field('item_text');
                                ?>
                                    <li class="contact-map-block__detail">
                                        <div class="contact-map-block__detail-icon" aria-hidden="true">
                                            <?php $render_icon($icon, $default_icons[$icon_type] ?? $default_icons['address']); ?>
                                        </div>

                                        <div class="contact-map-block__detail-content">
                                            <?php if ($item_title) : ?>
                                                <p class="contact-map-block__detail-title"><?php echo esc_html($item_title); ?></p>
                                            <?php endif; ?>

                                            <?php if ($item_text) : ?>
                                                <div class="contact-map-block__detail-text"><?php echo wp_kses_post($item_text); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (have_rows('social_links')) : ?>
                            <div class="contact-map-block__social">
                                <?php if ($social_title) : ?>
                                    <div class="contact-map-block__social-title"><?php echo wp_kses_post($social_title); ?></div>
                                <?php endif; ?>

                                <div class="contact-map-block__social-links">
                                    <?php while (have_rows('social_links')) : the_row();
                                        $social_icon = get_sub_field('icon');
                                        $social_link = get_sub_field('link');

                                        if (empty($social_link['url'])) {
                                            continue;
                                        }

                                        $social_url = $social_link['url'];
                                        $social_label = $social_link['title'] ?: $social_url;
                                        $social_target = $social_link['target'] ?: '_self';
                                    ?>
                                        <a class="contact-map-block__social-link" href="<?php echo esc_url($social_url); ?>" target="<?php echo esc_attr($social_target); ?>">
                                            <?php if ($social_icon) :
                                                $social_icon_url = $social_icon['url'] ?? '';
                                                $social_icon_alt = $social_icon['alt'] ?? '';
                                            ?>
                                                <img src="<?php echo esc_url($social_icon_url); ?>" alt="<?php echo esc_attr($social_icon_alt); ?>" width="14" height="14">
                                            <?php endif; ?>
                                            <span><?php echo esc_html($social_label); ?></span>
                                        </a>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endif; ?>

                <?php if ($directions_title || have_rows('directions_items')) : ?>
                    <article class="contact-map-block__card contact-map-block__card--directions">
                        <?php if ($directions_title) : ?>
                            <div class="contact-map-block__card-title">
                                <?php echo wp_kses_post($directions_title); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (have_rows('directions_items')) : ?>
                            <ul class="contact-map-block__directions">
                                <?php while (have_rows('directions_items')) : the_row();
                                    $direction_title = get_sub_field('item_title');
                                    $direction_text = get_sub_field('item_text');
                                ?>
                                    <li class="contact-map-block__direction">
                                        <?php if ($direction_title) : ?>
                                            <p class="contact-map-block__direction-title"><?php echo esc_html($direction_title); ?></p>
                                        <?php endif; ?>

                                        <?php if ($direction_text) : ?>
                                            <div class="contact-map-block__direction-text"><?php echo wp_kses_post($direction_text); ?></div>
                                        <?php endif; ?>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </article>
                <?php endif; ?>
            </div>

            <?php if ($map_src) : ?>
                <div class="contact-map-block__map">
                    <iframe
                        src="<?php echo esc_url($map_src); ?>"
                        title="<?php echo esc_attr__('Golden Break map', 'golden-break'); ?>"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen></iframe>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
