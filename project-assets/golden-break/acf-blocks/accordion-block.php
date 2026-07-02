<section class="accordion-block">

    <!-- Accordion Column -->

    <?php if (have_rows('accordion_column')) : ?>

        <div class="accordion-block__content">

            <?php while (have_rows('accordion_column')) : the_row(); ?>

                <!-- Accordion Items -->

                <ul class="accordion-block__column">

                    <?php if (have_rows('accordion')) : ?>

                        <?php while (have_rows('accordion')) : the_row(); ?>

                            <li class="accordion-block__column-item">

                                <?php if (get_sub_field('accordion_title')) : ?>
                                    <button
                                        class="accordion-block__column-title"
                                        data-function="accordion-toggle"
                                        aria-expanded="false"
                                        aria-controls="accordion-content-<?php echo get_row_index(); ?>">
                                        <?php echo esc_html(get_sub_field('accordion_title')); ?>
                                        <?php GetSvg::import('/assets/img/icons/chevron-down.svg'); ?>
                                    </button>
                                <?php endif; ?>

                                <?php if (get_sub_field('accordion_text')) : ?>
                                    <div
                                        id="accordion-content-<?php echo get_row_index(); ?>"
                                        class="accordion-block__column-content"
                                        aria-hidden="true"
                                        data-role="accordion-content">
                                        <div class="accordion-block__column-content-inner">
                                            <?php echo wp_kses_post(get_sub_field('accordion_text')); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </li>

                        <?php endwhile; ?>

                    <?php endif; ?>

                </ul>

                <!-- End Accordion Items -->

            <?php endwhile; ?>

        </div>

    <?php endif; ?>

    <!-- End Accordion Column -->

    <?php if (get_field('additional_text')) : ?>
        <div class="accordion-block__additional-text">
            <?php echo get_field('additional_text'); ?>
        </div>
    <?php endif; ?>

</section>