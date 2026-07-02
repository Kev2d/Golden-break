<footer class="site-footer">

    <section class="site-footer__main layout-xl">

        <?php get_template_part('template-parts/footer/footer-branding'); ?>

        <?php get_template_part('template-parts/footer/footer-links-desktop'); ?>
        <?php get_template_part('template-parts/footer/footer-links-mobile'); ?>

    </section>

    <section class="site-footer__bottom">

        <div class="site-footer__bottom-inside layout-xl">

            <?php get_template_part('template-parts/footer/footer-copyright'); ?>

            <?php get_template_part('template-parts/footer/footer-legal-links'); ?>

        </div>

    </section>

</footer>
<?php wp_footer(); ?>
</body>

</html>