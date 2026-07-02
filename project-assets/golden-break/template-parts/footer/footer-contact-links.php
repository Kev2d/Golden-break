<?php if (have_rows('footer_contact_links', 'option')) : ?>
    <div class="footer-links__column">
        <?php if (get_field('footer_contact_section_title', 'option')) : ?>
            <p class="footer-links__column-title"><?php echo get_field('footer_contact_section_title', 'option'); ?></p>
        <?php endif; ?>

        <nav class="footer-links__nav">
            <?php include 'footer-contact-links-list.php'; ?>
        </nav>
    </div>
<?php endif; ?>