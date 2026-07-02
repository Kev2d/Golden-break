<section class="content-overview-block">

    <?php if (have_rows('content_block')) : ?>

        <?php while (have_rows('content_block')) : the_row();
            $title_tag = get_sub_field('title_tag');
            if (!$title_tag) {
                $title_tag = 'h3';
            }
        ?>
            <div class="content-overview-block__item">
                <?php if (get_sub_field('title')) : ?>
                    <div class="content-overview-block__item-title">
                        <<?php echo esc_html($title_tag); ?>><?php echo esc_html(get_sub_field('title')); ?></<?php echo esc_html($title_tag); ?>>
                    </div>
                <?php endif; ?>

                <?php if (have_rows('list_of_links')) : ?>

                    <ul class="content-overview-block__list">

                        <?php while (have_rows('list_of_links')) : the_row(); ?>
                            <li class="content-overview-block__list-item">
                                <?php
                                $link = get_sub_field('link');
                                if ($link):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                    <a class="content-overview-block__list-item-link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                <?php endif; ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>

                <?php
                $link = get_sub_field('general_link');
                if ($link):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                    <a class="content-overview-block__item-link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?>
                        <?php GetSvg::import('/assets/img/icons/chevron-right.svg'); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>

    <?php endif; ?>

</section>