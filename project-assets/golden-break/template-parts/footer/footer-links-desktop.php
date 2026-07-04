<div class="footer-links footer-links--desktop">

    <?php if (have_rows('footer_links', 'option')) : ?>

        <!-- Desktop Version -->
        <?php while (have_rows('footer_links', 'option')) : the_row(); ?>
            <div class="footer-links__column">
                <?php if (get_sub_field('footer_link_column_title', 'option')) : ?>
                    <p class="footer-links__column-title">
                        <?php echo get_sub_field('footer_link_column_title', 'option'); ?>
                    </p>
                <?php endif; ?>
                <nav class="footer-links__nav">
                    <?php include 'footer-links-list.php'; ?>
                </nav>
            </div>
            <?php break; ?>
        <?php endwhile; ?>

    <?php endif; ?>

    <?php get_template_part('template-parts/footer/footer-contact-links'); ?>
    <?php get_template_part('template-parts/footer/footer-opening-hours'); ?>

</div>
