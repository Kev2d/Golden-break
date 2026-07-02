<?php if (have_rows('footer_social_media_icons', 'option')) : ?>

    <nav class="footer-social" aria-label="<?php _e('Social media links', 'keweb'); ?>">
        <ul class="footer-social__list">
            <?php while (have_rows('footer_social_media_icons', 'option')) : the_row(); ?>
                <li>
                    <?php $icon = get_sub_field('footer_social_media_icon', 'option'); ?>
                    <?php $link = get_sub_field('footer_social_media_link', 'option'); ?>

                    <?php if ($icon && $link) : ?>
                        <?php
                        // Determine the alt text
                        $alt_text = '';
                        if ('media_library' === $icon['type']) {
                            $attachment_id = $icon['value']['ID'];
                            $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
                        }

                        if (empty($alt_text)) {
                            $alt_text = __('Social media link', 'keweb');
                        }
                        ?>
                        <a href="<?php echo esc_url($link); ?>" aria-label="<?php echo esc_attr($alt_text); ?>">
                            <?php
                            if ('media_library' === $icon['type']) :
                                $attachment_id = $icon['value']['ID'];
                                $size = 'regular-icon';
                                echo wp_get_attachment_image($attachment_id, $size, false, array('alt' => $alt_text));
                            elseif ('url' === $icon['type']) :
                                $url = $icon['value'];
                            ?>
                                <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt_text); ?>" width="32" height="32">
                            <?php
                            endif;
                            ?>
                        </a>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </nav>

<?php endif; ?>