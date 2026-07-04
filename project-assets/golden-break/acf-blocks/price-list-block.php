<?php
$title = get_field('title');
$description = get_field('description');
$bottom_link = get_field('bottom_link');

if ($title) {
    $title = trim($title);
    $title = preg_replace('/^<p>(.*)<\/p>$/s', '$1', $title);
}
?>

<section class="price-list-block">
    <div class="price-list-block__inner layout-xl">
        <?php if ($title || $description) : ?>
            <div class="price-list-block__header layout-md">
                <?php if ($title) : ?>
                    <h2 class="price-list-block__title"><?php echo wp_kses_post($title); ?></h2>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <div class="price-list-block__description"><?php echo wp_kses_post($description); ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('price_list')) : ?>
            <div class="price-list-block__cards">
                <?php while (have_rows('price_list')) : the_row();
                    $title_tag = get_sub_field('title_tag') ?: 'h3';
                    $product_title = get_sub_field('product_title');
                    $price = trim((string) get_sub_field('price'));
                    $price_small_text = get_sub_field('price_small_text');
                    $is_popular = (bool) get_sub_field('is_popular');
                    $badge_text = get_sub_field('badge_text') ?: __('Populaarne', 'golden-break');
                    $is_numeric_price = $price !== '' && preg_match('/^\d+([,.]\d+)?\s*(\x{20AC}|eur)?$/iu', $price);

                    if ($is_numeric_price && !preg_match('/(\x{20AC}|eur)$/iu', $price)) {
                        $price .= "\u{20AC}";
                    }
                ?>
                    <article class="price-list-block__card<?php echo $is_popular ? ' price-list-block__card--popular' : ''; ?>">
                        <?php if ($is_popular) : ?>
                            <span class="price-list-block__card-badge"><?php echo esc_html($badge_text); ?></span>
                        <?php endif; ?>

                        <?php if ($product_title) : ?>
                            <<?php echo esc_html($title_tag); ?> class="price-list-block__card-title"><?php echo esc_html($product_title); ?></<?php echo esc_html($title_tag); ?>>
                        <?php endif; ?>

                        <?php if ($price !== '') : ?>
                            <p class="price-list-block__card-price<?php echo !$is_numeric_price ? ' price-list-block__card-price--text' : ''; ?>"><?php echo esc_html($price); ?></p>
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
                                        $list_item = trim($list_item);
                                        $list_item = preg_replace('/^<p>(.*)<\/p>$/s', '$1', $list_item);
                                    ?>
                                        <li class="price-list-block__card-list-item">
                                            <?php GetSvg::import('/assets/img/icons/checkmark.svg'); ?>
                                            <span><?php echo wp_kses_post($list_item); ?></span>
                                        </li>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </ul>
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
