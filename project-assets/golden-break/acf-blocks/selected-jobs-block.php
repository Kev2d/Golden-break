<section class="selected-jobs-block layout-lg">
    <?php
    $selected_jobs = get_field('selected_job');
    $even_jobs = [];
    $odd_jobs = [];

    if ($selected_jobs) :
        $job_count = 1;
        foreach ($selected_jobs as $post) :
            $is_odd_job = $job_count % 2 !== 0;
            if ($is_odd_job) {
                $even_jobs[] = $post;
            } else {
                $odd_jobs[] = $post;
            }
            $job_count++;
        endforeach;
    endif;
    ?>

    <?php if (!empty($even_jobs)) : ?>
        <div>
            <?php foreach ($even_jobs as $post) :
                $title = $post->post_title;
                $url = get_permalink($post->ID);

                $image_id = get_post_thumbnail_id($post);
                $image_url = wp_get_attachment_image_url($image_id, 'large');
                $image_meta = wp_get_attachment_metadata($image_id);
                $image_width = $image_meta['width'] ?? '';
                $image_height = $image_meta['height'] ?? '';
                $image_mobile = wp_get_attachment_image_src($image_id, 'mobile-image');
                $image_tablet = wp_get_attachment_image_src($image_id, 'tablet-image');
            ?>
                <article class='job'>
                    <a href='<?php echo esc_url($url); ?>'>
                        <?php if ($image_url) : ?>
                            <picture>
                                <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile'); ?>px)" srcset="<?php echo esc_url($image_mobile[0] ?? ''); ?>">
                                <source media="(max-width:<?php echo Theme_Config::get_breakpoint('tablet'); ?>px)" srcset="<?php echo esc_url($image_tablet[0] ?? ''); ?>">
                                <img
                                    src="<?php echo esc_url($image_url); ?>"
                                    alt="<?php echo esc_attr($title); ?>"
                                    width="<?php echo esc_attr($image_width); ?>"
                                    height="<?php echo esc_attr($image_height); ?>" />
                            </picture>
                        <?php endif; ?>
                        <p><?php echo esc_html($title); ?></p>
                        <?php
                        $technical_info = get_field('portfolio_technical_info', $post->ID);
                        if ($technical_info) : ?>
                            <div class='technical-info'>
                                <?php foreach ($technical_info as $info) : ?>
                                    <?php echo esc_html($info); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($odd_jobs)) : ?>
        <div>
            <?php foreach ($odd_jobs as $post) :
                $title = $post->post_title;
                $url = get_permalink($post->ID);

                $image_id = get_post_thumbnail_id($post);
                $image_url = wp_get_attachment_image_url($image_id, 'large');
                $image_meta = wp_get_attachment_metadata($image_id);
                $image_width = $image_meta['width'] ?? '';
                $image_height = $image_meta['height'] ?? '';
                $image_mobile = wp_get_attachment_image_src($image_id, 'mobile-image');
                $image_tablet = wp_get_attachment_image_src($image_id, 'tablet-image');
            ?>
                <article class='job'>
                    <a href='<?php echo esc_url($url); ?>'>
                        <?php if ($image_url) : ?>
                            <picture>
                                <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile'); ?>px)" srcset="<?php echo esc_url($image_mobile[0] ?? ''); ?>">
                                <source media="(max-width:<?php echo Theme_Config::get_breakpoint('tablet'); ?>px)" srcset="<?php echo esc_url($image_tablet[0] ?? ''); ?>">
                                <img
                                    src="<?php echo esc_url($image_url); ?>"
                                    alt="<?php echo esc_attr($title); ?>"
                                    width="<?php echo esc_attr($image_width); ?>"
                                    height="<?php echo esc_attr($image_height); ?>" />
                            </picture>
                        <?php endif; ?>
                        <p><?php echo esc_html($title); ?></p>
                        <?php
                        $technical_info = get_field('portfolio_technical_info', $post->ID);
                        if ($technical_info) : ?>
                            <div class='technical-info'>
                                <?php foreach ($technical_info as $info) : ?>
                                    <?php echo esc_html($info); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
