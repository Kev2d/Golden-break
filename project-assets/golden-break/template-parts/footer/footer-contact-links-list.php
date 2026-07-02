<ul class="footer-links__list">
    <?php while (have_rows('footer_contact_links', 'option')) : the_row(); ?>
        <li class="footer-links__list-item">
            <?php $type = get_sub_field('footer_contact_type'); ?>
            <?php $contact_link = get_sub_field('footer_contact_link'); ?>
            <?php $regular_link = get_sub_field('footer_contact_type_link'); ?>

            <?php if ($type === 'email' && $contact_link) : ?>
                <a class="footer-links__list-item-link" href="mailto:<?php echo esc_attr($contact_link); ?>">
                    <?php GetSvg::import('/assets/img/icons/email.svg'); ?>
                    <?php echo esc_html($contact_link); ?>
                </a>
            <?php endif; ?>

            <?php if ($type === 'number' && $contact_link) : ?>
                <a class="footer-links__list-item-link" href="tel:+<?php echo esc_attr($contact_link); ?>">
                    <?php GetSvg::import('/assets/img/icons/phone.svg'); ?>
                    <?php echo esc_html($contact_link); ?>
                </a>
            <?php endif; ?>

            <?php if ($type === 'link' && $regular_link) : ?>
                <?php
                $link_url = $regular_link['url'];
                $link_title = $regular_link['title'];
                $link_target = $regular_link['target'] ? $regular_link['target'] : '_self';
                ?>
                <a class="footer-links__list-item-link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                    <?php GetSvg::import('/assets/img/icons/link.svg'); ?>
                    <?php echo esc_html($link_title); ?>
                </a>
            <?php endif; ?>

            <?php if ($type === 'text' && $contact_link) : ?>
                <p><?php echo esc_html($contact_link); ?></p>
            <?php endif; ?>
        </li>
    <?php endwhile; ?>
</ul>