<?php if (have_rows('footer_legal_links', 'option')) : ?>
    <nav class="footer-legal-links">
        <ul class="footer-legal-links__menu">
            <?php while (have_rows('footer_legal_links', 'option')) : the_row(); ?>

                <?php
                $link = get_sub_field('footer_legal_link', 'option');
                if ($link):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                    <li class="footer-legal-links__menu-item">
                        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                    </li>
                <?php endif; ?>

            <?php endwhile; ?>

        </ul>
    </nav>

<?php endif; ?>