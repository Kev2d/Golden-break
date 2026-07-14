<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta name="description" content="<?php echo Custom_Title_Manager::get_description(); ?>">
  <meta charset="utf-8">
  <title><?php echo Custom_Title_Manager::get_title(); ?></title>
  <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins/poppins-400.woff2" as="font" type="font/woff2" crossorigin="anonymous">
  <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins/poppins-500.woff2" as="font" type="font/woff2" crossorigin="anonymous">

  <?php wp_head(); ?>

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<?php wp_body_open(); ?>

<div class="site-header-slot">
<header class="site-header">

  <div class="site-header__inner">
    <div class="site-header__brand">
      <?php get_template_part('template-parts/header/site-logo'); ?>
    </div>

    <div class="site-header__nav">
      <?php get_template_part('template-parts/header/navigation'); ?>
    </div>

    <div class="site-header__actions">
      <?php get_template_part('template-parts/UI/language-menu'); ?>
      <?php get_template_part('template-parts/header/booking-cta'); ?>
    </div>

    <?php get_template_part('template-parts/UI/hamburger'); ?>
  </div>

  <?php get_template_part('template-parts/header/navigation-mobile'); ?>

</header>
</div>
