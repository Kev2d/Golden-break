<section class="title-text-block layout-md">

    <?php if (get_field('title')) : ?>
        <div class="title-text-block__title"><?php echo get_field('title'); ?></div>
    <?php endif; ?>

    <?php if (get_field('text')) : ?>
        <div class="title-text-block__text"> <?php echo get_field('text'); ?></div>
    <?php endif; ?>

</section>