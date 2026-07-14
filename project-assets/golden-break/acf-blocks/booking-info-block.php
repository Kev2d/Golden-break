<?php
$rules_title = get_field('rules_title');
$contact_title = get_field('contact_title');
$contact_description = get_field('contact_description');

$icon_paths = [
    'phone' => '/assets/img/icons/footer-phone.svg',
    'email' => '/assets/img/icons/footer-email.svg',
    'location' => '/assets/img/icons/footer-location.svg',
];
?>

<section class="booking-info-block">
    <div class="booking-info-block__inner layout-xl">
        <div class="booking-info-block__cards">
            <article class="booking-info-block__card">
                <?php if ($rules_title) : ?>
                    <h2 class="booking-info-block__card-title"><?php echo esc_html($rules_title); ?></h2>
                <?php endif; ?>

                <?php if (have_rows('rules')) : ?>
                    <ul class="booking-info-block__list">
                        <?php while (have_rows('rules')) : the_row();
                            $rule_text = get_sub_field('rule_text');
                        ?>
                            <?php if ($rule_text) : ?>
                                <li class="booking-info-block__list-item">
                                    <svg class="booking-info-block__check" aria-hidden="true" viewBox="0 0 16 16" focusable="false">
                                        <path d="M13.25 4.75 6.75 11.25 3.5 8"></path>
                                    </svg>
                                    <span><?php echo esc_html($rule_text); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </article>

            <article class="booking-info-block__card">
                <?php if ($contact_title) : ?>
                    <h2 class="booking-info-block__card-title"><?php echo esc_html($contact_title); ?></h2>
                <?php endif; ?>

                <?php if ($contact_description) : ?>
                    <div class="booking-info-block__description">
                        <?php echo wp_kses_post($contact_description); ?>
                    </div>
                <?php endif; ?>

                <?php if (have_rows('contacts')) : ?>
                    <ul class="booking-info-block__contacts">
                        <?php while (have_rows('contacts')) : the_row();
                            $icon = get_sub_field('contact_icon') ?: 'phone';
                            $label = get_sub_field('contact_label');
                            $url = get_sub_field('contact_url');
                            $icon_path = $icon_paths[$icon] ?? $icon_paths['phone'];
                        ?>
                            <?php if ($label) : ?>
                                <li class="booking-info-block__contact-item">
                                    <?php if ($url) : ?>
                                        <a class="booking-info-block__contact-link" href="<?php echo esc_url($url); ?>">
                                            <?php GetSvg::import($icon_path); ?>
                                            <span><?php echo esc_html($label); ?></span>
                                        </a>
                                    <?php else : ?>
                                        <span class="booking-info-block__contact-link">
                                            <?php GetSvg::import($icon_path); ?>
                                            <span><?php echo esc_html($label); ?></span>
                                        </span>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </article>
        </div>
    </div>
</section>
