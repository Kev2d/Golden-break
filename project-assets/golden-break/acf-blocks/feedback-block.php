<section class="feedback-block layout-xl">
    <?php
    $title_tag = get_field('title_tag');
    if (!$title_tag) {
        $title_tag = 'h2';
    }
    ?>
    <?php if (get_field('title')) : ?>
        <<?php echo esc_html($title_tag); ?> class="feedback-block__title layout-sm"><?php echo esc_html(get_field('title')); ?></<?php echo esc_html($title_tag); ?>>
    <?php endif; ?>

    <div class="latest-posts-block__wrapper custom-swiper-container-desktop">

        <?php
        $slider_id = 'content-slider-' . substr(uniqid(), -5);
        ?>

        <?php get_template_part('template-parts/UI/content-controls', null, array(
            'slider_id' => $slider_id,
            'show_on_desktop' => true,
        )); ?>


        <?php if (have_rows('feedback')) : ?>
            <ul id="<?php echo esc_attr($slider_id); ?>" class="feedback-block__feedback custom-swiper-wrapper">
                <?php while (have_rows('feedback')) : the_row(); ?>
                    <li class="feedback-block__feedback-feedback custom-swiper-slide">
                        <div class="feedback-block__feedback-feedback-content">

                            <div class="feedback-top">
                                <div class="feedback-rating">
                                    <?php
                                    for ($i = 0; $i < 5; $i++) {
                                        GetSvg::import('/assets/img/icons/rating-star.svg');
                                    }
                                    ?>
                                </div>

                                <?php if (get_sub_field('feedback_date')) : ?>
                                    <time class="feedback-date" datetime="<?php echo esc_attr(date('Y-m-d', strtotime(get_sub_field('feedback_date')))); ?>">
                                        <?php echo esc_html(get_sub_field('feedback_date')); ?>
                                    </time>
                                <?php endif; ?>
                            </div>

                            <?php if (get_sub_field('feedback_text')) : ?>
                                <?php echo get_sub_field('feedback_text'); ?>
                            <?php endif; ?>


                            <div class="feedback-author">
                                <?php if (get_sub_field('feedback_name')) : ?>
                                    <p class="feedback-name"><?php echo get_sub_field('feedback_name'); ?></p>
                                <?php endif; ?>

                                <?php if (get_sub_field('feedback_company')) : ?>
                                    <p class="feedback-company"><?php echo get_sub_field('feedback_company'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php
                endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>