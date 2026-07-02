<section class="price-list-block custom-swiper-container">

    <?php
    $slider_id = 'content-slider-' . substr(uniqid(), -5);
    ?>

    <?php get_template_part('template-parts/UI/content-controls', null, array(
        'slider_id' => $slider_id,
    )); ?> <!-- Mobile only -->

    <div id="<?php echo esc_attr($slider_id); ?>" class="price-list-block__wrapper custom-swiper-wrapper">
        <?php if (have_rows('price_list')) : ?>

            <?php while (have_rows('price_list')) : the_row(); ?>

                <?php $title_tag = get_sub_field('title_tag');
                if (!$title_tag) {
                    $title_tag = 'h4';
                }
                ?>

                <div class="price-list-block__item custom-swiper-slide">
                    <div>
                        <div class="price-list-block__item-content">
                            <?php if (get_sub_field('product_title')) : ?>
                                <<?php echo esc_html($title_tag); ?> class="price-list-block__item-title"><?php echo esc_html(get_sub_field('product_title')); ?></<?php echo esc_html($title_tag); ?>>
                            <?php endif; ?>

                            <?php if (get_sub_field('product_short_description')) : ?>
                                <p class="price-list-block__item-description"><?php echo get_sub_field('product_short_description'); ?></p>
                            <?php endif; ?>
                        </div>

                        <hr>

                        <div class="price-list-block__item-content">
                            <?php
                            $price = get_sub_field('price');
                            ?>
                            <span class="price-list-block__item-price">
                                <?php
                                echo trim($price) !== '' ? $price . '€' : '-';
                                ?>
                            </span>

                            <?php if (get_sub_field('price_small_text')) : ?>
                                <p class="price-list-block__item-price-text"><?php echo get_sub_field('price_small_text'); ?></p>
                            <?php endif; ?>
                        </div>

                        <?php
                        $link = get_sub_field('cta');
                        if ($link):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                            <a class="price-list-block__item-cta button--primary-rounded-md" role="button" aria-label="<?php echo esc_attr($link_title); ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                        <?php endif; ?>

                        <?php
                        $list_text = get_sub_field('list_text');
                        $features_list = get_sub_field('features_list');
                        ?>

                        <?php if ($list_text || $features_list) : ?>

                            <ul class="price-list-block__item-list">
                                <?php if ($list_text) : ?>
                                    <li class="price-list-block__item-list-text"><?php echo $list_text; ?></li>
                                <?php endif; ?>

                                <?php if (have_rows('features_list')) : ?>

                                    <?php while (have_rows('features_list')) : the_row(); ?>

                                        <?php if (get_sub_field('list_item')) : ?>
                                            <li class="price-list-block__item-list-item"><?php GetSvg::import('/assets/img/icons/checkmark.svg'); ?><?php echo get_sub_field('list_item'); ?></li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>

                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>