<section class="content-features-block layout-lg">

    <?php if (have_rows('features')) : ?>

        <?php while (have_rows('features')) : the_row();

            $title_tag = get_sub_field('title_tag');
            if (!$title_tag) {
                $title_tag = 'h4';
            }
        ?>

            <div class="content-features-block__item">

                <?php $icon = get_sub_field('icon'); ?>

                <?php if (!empty($icon) && !empty($icon['type']) && !empty($icon['value'])) : ?>
                    <div class="content-features-block__item-icon" aria-hidden="true">
                        <?php
                        if ('media_library' === $icon['type']) :
                            $attachment_id = $icon['value']['ID'];
                            $size = 'regular-icon';

                            $image_html = wp_get_attachment_image($attachment_id, $size, false, array('alt' => __('Social media icon', 'golden-break')));
                            echo wp_kses_post($image_html);
                        endif;

                        if ('url' === $icon['type']) :
                            $url = $icon['value'];
                        ?>
                            <img
                                src="<?php echo esc_url($url); ?>"
                                alt="<?php _e('Feature icon', 'golden-break'); ?>"
                                width="32"
                                height="32">
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="content-features-block__item-content">

                    <?php if (get_sub_field('title')) : ?>
                        <<?php echo esc_html($title_tag); ?> class="title"><?php echo esc_html(get_sub_field('title')); ?></<?php echo esc_html($title_tag); ?>>
                    <?php endif; ?>

                    <?php if (get_sub_field('text')) : ?>
                        <p class="text"> <?php echo get_sub_field('text'); ?></p>
                    <?php endif; ?>

                </div>
            </div>
        <?php endwhile; ?>

    <?php endif; ?>


</section>