<!doctype html>
<html <?php echo ThemeManager::getTheme() ? 'data-theme="' . esc_attr(ThemeManager::getTheme()) . '"' : ''; ?> <?php language_attributes(); ?>>

<head>
  <meta name="description" content="<?php echo Custom_Title_Manager::get_description(); ?>">
  <meta charset="utf-8">
  <title><?php echo Custom_Title_Manager::get_title(); ?></title>
  <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins/poppins-400.woff2" as="font" type="font/woff2" crossorigin="anonymous">
  <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins/poppins-500.woff2" as="font" type="font/woff2" crossorigin="anonymous">

  <?php wp_head(); ?>

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<?php get_template_part('template-parts/UI/site-notification'); ?>
<header class="site-header layout-xl">

  <div class="site-header__left">
    <?php get_template_part('template-parts/UI/hamburger'); ?> <!-- Mobile only -->
    <?php get_template_part('template-parts/header/site-logo'); ?>
    <?php get_template_part('template-parts/header/navigation'); ?>
    <?php get_template_part('template-parts/header/navigation-mobile'); ?> <!-- Mobile only -->
    <?php get_template_part('template-parts/UI/settings-menu'); ?> <!-- Mobile only -->
  </div>

  <!-- Desktop only -->
  <div class="site-header__right">
    <?php get_template_part('template-parts/UI/language-menu'); ?>
    <?php get_template_part('template-parts/UI/settings-menu'); ?>
  </div>

</header>

<body>