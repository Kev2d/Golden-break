<?php $title_tag = get_field('title_tag');
if (!$title_tag) {
    $title_tag = 'h2';
}
?>

<section class="contact-info-block">

    <div class="contact-info-block__content">
        <?php if (get_field('title')) : ?>
            <<?php echo esc_html($title_tag); ?> class="contact-info-block__title"><?php echo esc_html(get_field('title')); ?></<?php echo esc_html($title_tag); ?>>
        <?php endif; ?>

        <?php if (get_field('text')) : ?>
            <div class="contact-info-block__text"><?php echo get_field('text'); ?></div>
        <?php endif; ?>
    </div>

    <?php if (have_rows('contact_cards')) : ?>
        <div class="contact-info-block__cards">
            <?php while (have_rows('contact_cards')) : the_row(); ?>
                <div class="contact-info-block__card">
                    <?php $icon = get_sub_field('icon', 'option'); ?>

                    <?php if ($icon) : ?>
                        <div class="contact-info-block__card-icon" aria-hidden="true">
                            <?php
                            if ('media_library' === $icon['type']) :
                                $attachment_id = $icon['value']['ID'];
                                $image_src = wp_get_attachment_image_url($attachment_id, 'regular-icon');
                                $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ?: __('Social media icon', 'keweb');

                                // Render SVG if applicable
                                $svg_content = SvgRenderer::render($image_src);
                                if ($svg_content) {
                                    echo $svg_content; // Render SVG
                                } else {
                                    echo wp_get_attachment_image($attachment_id, 'regular-icon', false, array('alt' => $image_alt)); // Fallback for non-SVGs
                                }

                            elseif ('url' === $icon['type']) :
                                $url = $icon['value'];

                                // Render SVG if applicable
                                $svg_content = SvgRenderer::render($url);
                                if ($svg_content) {
                                    echo $svg_content; // Render SVG
                                } else {
                                    echo '<img src="' . esc_url($url) . '" 
                                    alt="' . esc_attr(__('Social media icon', 'keweb')) . '" 
                                    width="32" 
                                    height="32">';
                                }
                            endif;
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if (get_sub_field('card_title')) : ?>
                        <p class="contact-info-block__card-title"><?php echo get_sub_field('card_title'); ?></p>
                    <?php endif; ?>

                    <?php if (get_sub_field('card_description')) : ?>
                        <p class="contact-info-block__card-description"><?php echo get_sub_field('card_description'); ?></p>
                    <?php endif; ?>

                    <!-- Contact types -->
                    <div class="contact-info-block__card-contact">
                        <?php $type = get_sub_field('contact_type'); ?>
                        <?php $contact_link = get_sub_field('contact_link'); ?>
                        <?php $regular_link = get_sub_field('contact_type_link'); ?>

                        <?php if ($type === 'email' && $contact_link) : ?>
                            <a class="contact-info-block__card-contact-link contact-info-block__card-contact-link--email" href="mailto:<?php echo esc_attr($contact_link); ?>" aria-label="Email <?php echo esc_attr($contact_link); ?>">
                                <?php echo esc_html($contact_link); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ($type === 'number' && $contact_link) : ?>
                            <a class="contact-info-block__card-contact-link contact-info-block__card-contact-link--number" href="tel:+<?php echo esc_attr($contact_link); ?>" aria-label="Call <?php echo esc_attr($contact_link); ?>">
                                <?php echo esc_html($contact_link); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ($type === 'link' && $regular_link) : ?>
                            <?php
                            $link_url = $regular_link['url'];
                            $link_title = $regular_link['title'];
                            $link_target = $regular_link['target'] ? $regular_link['target'] : '_self';
                            ?>
                            <a class="contact-info-block__card-contact-link contact-info-block__contact-link--web" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" aria-label="<?php echo esc_attr($link_title); ?>">
                                <?php echo esc_html($link_title); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ($type === 'text' && $contact_link) : ?>
                            <p class="contact-info-block__card-contact-text"><?php echo esc_html($contact_link); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

    <?php if (have_rows('contact_personel')) : ?>
        <div class="contact-info-block__personnel">
            <?php while (have_rows('contact_personel')) : the_row(); ?>
                <div class="contact-info-block__person">
                    <?php if (get_sub_field('image')) :
                        $image = get_sub_field('image');
                        $image_src = $image['sizes']['thumbnail'];
                        $image_alt = $image['alt'];
                        $image_width = $image['sizes']['thumbnail-width'];
                        $image_height = $image['sizes']['thumbnail-height'];
                    ?>
                        <img
                            class="contact-info-block__person-image"
                            src="<?php echo esc_url($image_src); ?>"
                            alt="<?php echo esc_attr($image_alt); ?>"
                            width="<?php echo esc_attr($image_width); ?>"
                            height="<?php echo esc_attr($image_height); ?>" />
                    <?php endif; ?>

                    <div class="contact-info-block__person-content">

                        <?php if (get_sub_field('name')) : ?>
                            <p class="contact-info-block__person-content-name"><?php echo get_sub_field('name'); ?></p>
                        <?php endif; ?>

                        <?php if (get_sub_field('position')) : ?>
                            <p class="contact-info-block__person-content-position"><?php echo get_sub_field('position'); ?></p>
                        <?php endif; ?>

                        <?php if (get_sub_field('location')) : ?>
                            <p class="contact-info-block__person-content-location"><?php echo get_sub_field('location'); ?></p>
                        <?php endif; ?>

                        <?php if (get_sub_field('email')) : ?>
                            <a class="contact-info-block__person-content-email" href="mailto:<?php echo get_sub_field('email'); ?>" aria-label="Email <?php echo get_sub_field('email'); ?>"><?php echo get_sub_field('email'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

</section>