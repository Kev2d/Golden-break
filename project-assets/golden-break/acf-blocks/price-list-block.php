<?php
$title = get_field('title');
$description = get_field('description');
$bottom_link = get_field('bottom_link');
$price_list_rows = get_field('price_list');
$price_list_count = is_array($price_list_rows) ? count($price_list_rows) : 0;
$block_classes = ['price-list-block'];

if ($price_list_count === 2) {
    $block_classes[] = 'price-list-block--two-cards';
}

$clean_price_list_text = static function ($value) {
    $value = trim((string) $value);

    return preg_replace('/^<p>(.*)<\/p>$/s', '$1', $value);
};
$format_price_text = static function ($value) {
    $value = trim((string) $value);
    $is_numeric_price = $value !== '' && preg_match('/^\d+([,.]\d+)?\s*(\x{20AC}|eur)?$/iu', $value);

    if ($is_numeric_price && !preg_match('/(\x{20AC}|eur)$/iu', $value)) {
        $value .= "\u{20AC}";
    }

    return [
        'value' => $value,
        'is_numeric' => $is_numeric_price,
    ];
};

if ($title) {
    $title = $clean_price_list_text($title);
}
?>

<section class="<?php echo esc_attr(implode(' ', $block_classes)); ?>">
    <div class="price-list-block__inner layout-xl">
        <?php if ($title || $description) : ?>
            <div class="price-list-block__header">
                <?php if ($title) : ?>
                    <div class="price-list-block__title"><?php echo wp_kses_post($title); ?></div>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <div class="price-list-block__description"><?php echo wp_kses_post($description); ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('price_list')) : ?>
            <div class="price-list-block__cards">
                <?php while (have_rows('price_list')) : the_row();
                    $product_title = get_sub_field('product_title');
                    $price_data = $format_price_text(get_sub_field('price'));
                    $price = $price_data['value'];
                    $is_numeric_price = $price_data['is_numeric'];
                    $original_price_data = $format_price_text(get_sub_field('original_price'));
                    $original_price = $original_price_data['value'];
                    $savings_text = get_sub_field('savings_text');
                    $price_small_text = get_sub_field('price_small_text');
                    $card_link = get_sub_field('card_link');
                    $is_popular = (bool) get_sub_field('is_popular');
                    $badge_text = get_sub_field('badge_text') ?: __('Populaarne', 'golden-break');
                ?>
                    <article class="price-list-block__card<?php echo $is_popular ? ' price-list-block__card--popular' : ''; ?>">
                        <?php if ($is_popular) : ?>
                            <span class="price-list-block__card-badge"><?php echo esc_html($badge_text); ?></span>
                        <?php endif; ?>

                        <?php if ($product_title) :
                            $product_title = $clean_price_list_text($product_title);
                        ?>
                            <div class="price-list-block__card-title"><?php echo wp_kses_post($product_title); ?></div>
                        <?php endif; ?>

                        <?php if ($price !== '') : ?>
                            <p class="price-list-block__card-price<?php echo !$is_numeric_price ? ' price-list-block__card-price--text' : ''; ?>"><?php echo esc_html($price); ?></p>
                        <?php endif; ?>

                        <?php if ($original_price !== '') : ?>
                            <p class="price-list-block__card-original-price"><?php echo esc_html($original_price); ?></p>
                        <?php endif; ?>

                        <?php if ($savings_text) : ?>
                            <p class="price-list-block__card-savings"><?php echo esc_html($savings_text); ?></p>
                        <?php endif; ?>

                        <?php if ($price_small_text) : ?>
                            <p class="price-list-block__card-price-text"><?php echo esc_html($price_small_text); ?></p>
                        <?php endif; ?>

                        <?php if (have_rows('features_list')) : ?>
                            <ul class="price-list-block__card-list">
                                <?php while (have_rows('features_list')) : the_row(); ?>
                                    <?php
                                    $list_item = get_sub_field('list_item');

                                    if ($list_item) :
                                        $list_item = $clean_price_list_text($list_item);
                                    ?>
                                        <li class="price-list-block__card-list-item">
                                            <?php GetSvg::import('/assets/img/icons/checkmark.svg'); ?>
                                            <span><?php echo esc_html($list_item); ?></span>
                                        </li>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (!empty($card_link['url'])) :
                            $card_link_url = $card_link['url'];
                            $card_link_title = $card_link['title'] ?: __('Vaata rohkem', 'golden-break');
                            $card_link_target = $card_link['target'] ?: '_self';
                        ?>
                            <a class="price-list-block__card-link" href="<?php echo esc_url($card_link_url); ?>" target="<?php echo esc_attr($card_link_target); ?>">
                                <span><?php echo esc_html($card_link_title); ?></span>
                                <?php GetSvg::import('/assets/img/icons/button-arrow-right.svg'); ?>
                            </a>
                        <?php endif; ?>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($bottom_link['url'])) :
            $link_url = $bottom_link['url'];
            $link_title = $bottom_link['title'] ?: __('Vaata koiki hindu ja pakette', 'golden-break');
            $link_target = $bottom_link['target'] ?: '_self';
        ?>
            <a class="price-list-block__link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                <span><?php echo esc_html($link_title); ?></span>
                <?php GetSvg::import('/assets/img/icons/button-arrow-right.svg'); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
