<?php
$title = get_field('title');
$description = get_field('description');
$button = get_field('button');
$title_tag = get_field('title_size') ?: get_field('title_tag');

if (!$title_tag) {
    $title_tag = 'h2';
}

$default_icons = [
    '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="3" y="5" width="18" height="16" rx="2"></rect><path d="M16 3v4M8 3v4M3 11h18"></path></svg>',
    '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M8 21h8M12 17v4"></path><path d="M7 4h10v5a5 5 0 0 1-10 0V4Z"></path><path d="M5 5H3v2a4 4 0 0 0 4 4M19 5h2v2a4 4 0 0 1-4 4"></path></svg>',
    '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M16 21v-2a4 4 0 0 0-8 0v2"></path><circle cx="12" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
];

if ($title) {
    $title = trim($title);
    $title = preg_replace('/^<p>(.*)<\/p>$/s', '$1', $title);
}
?>

<section class="features-block">
    <div class="features-block__inner layout-xl">
        <?php if ($title || $description) : ?>
            <div class="features-block__header layout-md">
                <?php if ($title) : ?>
                    <<?php echo esc_html($title_tag); ?> class="features-block__title"><?php echo wp_kses_post($title); ?></<?php echo esc_html($title_tag); ?>>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <div class="features-block__description"><?php echo wp_kses_post($description); ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('features')) : ?>
            <ul class="features-block__features">
                <?php while (have_rows('features')) : the_row();
                    $index = get_row_index();
                    $image = get_sub_field('feature_image');
                    $feature_title = get_sub_field('feature_title');
                    $feature_text = get_sub_field('feature_text');
                ?>
                    <li class="features-block__features-feature">
                        <div class="feature-icon" aria-hidden="true">
                            <?php
                            if ($image) :
                                $image_url = $image['url'];
                                $is_svg = str_ends_with($image_url, '.svg');
                                $image_alt = $image['alt'] ?? '';

                                if ($is_svg) :
                                    $svg_content = SvgRenderer::render($image_url);

                                    if ($svg_content) :
                                        echo $svg_content;
                                    else :
                                        echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" width="32" height="32">';
                                    endif;
                                else :
                                    echo wp_get_attachment_image($image['ID'], 'regular-icon', false, ['alt' => $image_alt]);
                                endif;
                            else :
                                echo $default_icons[$index - 1] ?? $default_icons[0];
                            endif;
                            ?>
                        </div>

                        <?php if ($feature_title) : ?>
                            <h3 class="feature-title"><span><?php echo esc_html($index); ?>.</span> <?php echo esc_html($feature_title); ?></h3>
                        <?php endif; ?>

                        <?php if ($feature_text) : ?>
                            <div class="feature-text"><?php echo wp_kses_post($feature_text); ?></div>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($button['url'])) :
            $link_url = $button['url'];
            $link_title = $button['title'] ?: __('Alusta broneerimist', 'golden-break');
            $link_target = $button['target'] ?: '_self';
        ?>
            <a class="features-block__button" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                <span><?php echo esc_html($link_title); ?></span>
                <?php GetSvg::import('/assets/img/icons/button-arrow-right.svg'); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
