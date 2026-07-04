<?php get_header(); ?>

<div class="error-page layout-xl">
    <h1 class="error-page-emoji">🙁</h1>
    <h1 class="error-page-title">404</h1>
    <p class="error-page-text"><?php echo __('Whoops... Page not found!!!', 'golden-break'); ?></p>
    <a class="error-page-button button--default" href="<?php echo get_home_url(); ?>"><?php echo __('Go Home', 'golden-break'); ?></a>
</div>

<?php get_footer(); ?>