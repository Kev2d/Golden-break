<ul class="footer-links__list">
    <?php if (have_rows('footer_column_links', 'option')) : ?>
        <?php while (have_rows('footer_column_links', 'option')) : the_row(); ?>
            <li class="footer-links__list-item">
                <?php
                $link = get_sub_field('footer_column_link', 'option');
                if ($link):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                    <a class="footer-links__list-item-link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                <?php endif; ?>
            </li>
        <?php endwhile; ?>
    <?php endif; ?>
</ul>
