<div class="footer-links footer-links--mobile">

    <?php if (have_rows('footer_links', 'option')) : ?>

        <!-- Mobile Version -->
        <?php while (have_rows('footer_links', 'option')) : the_row(); ?>
            <div class="footer-links__column">
                <?php if (get_sub_field('footer_link_column_title', 'option')) : ?>
                    <button class="footer-links__column-title" data-function="accordion-toggle" aria-expanded="false" aria-controls="footer-nav-mobile-<?php echo get_row_index(); ?>">
                        <?php echo get_sub_field('footer_link_column_title', 'option'); ?>
                        <?php GetSvg::import('/assets/img/icons/chevron-down.svg'); ?>
                    </button>
                <?php endif; ?>
                <nav id="footer-nav-mobile-<?php echo get_row_index(); ?>" class="footer-links__nav" aria-hidden="true" data-role="accordion-content" inert>
                    <?php include 'footer-links-list.php'; ?>
                </nav>
            </div>
            <?php break; ?>
        <?php endwhile; ?>

    <?php endif; ?>

    <?php get_template_part('template-parts/footer/footer-contact-links'); ?>
    <?php get_template_part('template-parts/footer/footer-opening-hours'); ?>

</div>
