<?php
$title = get_field('title');
$description = get_field('description');
$primary_link = get_field('primary_link');
$secondary_link = get_field('secondary_link');
$has_primary_link = !empty($primary_link['url']);
$has_secondary_link = !empty($secondary_link['url']);
$actions_count = (int) $has_primary_link + (int) $has_secondary_link;
$block_classes = ['cta-block'];

if ($actions_count === 1) {
    $block_classes[] = 'cta-block--single-action';
} elseif ($actions_count > 1) {
    $block_classes[] = 'cta-block--double-action';
}
?>

<section class="<?php echo esc_attr(implode(' ', $block_classes)); ?>">
    <div class="cta-block__inner layout-xl">
        <article class="cta-block__panel">
            <?php if ($title) : ?>
                <div class="cta-block__title">
                    <?php echo wp_kses_post($title); ?>
                </div>
            <?php endif; ?>

            <?php if ($description) : ?>
                <div class="cta-block__description">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>

            <?php if ($actions_count > 0) : ?>
                <div class="cta-block__actions">
                    <?php if ($has_primary_link) :
                        $link_url = $primary_link['url'];
                        $link_title = $primary_link['title'] ?: __('Broneeri laud', 'golden-break');
                        $link_target = $primary_link['target'] ?: '_self';
                    ?>
                        <a class="cta-block__button cta-block__button--primary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                            <svg aria-hidden="true" viewBox="0 0 24 24" focusable="false">
                                <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                                <path d="M16 3v4M8 3v4M3 11h18"></path>
                            </svg>
                            <span><?php echo esc_html($link_title); ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if ($has_secondary_link) :
                        $link_url = $secondary_link['url'];
                        $link_title = $secondary_link['title'] ?: __('Küsi pakkumist ürituseks', 'golden-break');
                        $link_target = $secondary_link['target'] ?: '_self';
                    ?>
                        <a class="cta-block__button cta-block__button--secondary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                            <span><?php echo esc_html($link_title); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </article>
    </div>
</section>
