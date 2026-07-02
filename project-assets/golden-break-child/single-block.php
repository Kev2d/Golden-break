<?php
get_header(); // Include the header
?>
<main class="single-blocks layout-xl">

    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>

            <article class="single-blocks__post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <header class="single-blocks__post-top">

                    <div class="single-blocks__info">
                        <div class="single-blocks__info-inside">
                            <h1 class="single-blocks__info-title"><?php the_title(); ?></h1>

                            <!-- Excerpt -->
                            <div class="single-blocks__info-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- Featured Image -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="single-blocks__info-thumbnail">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>

                </header>
                <!-- Title -->

                <!-- Content -->
                <div class="single-blocks__post-content">
                    <?php the_content(); ?>
                </div>

            </article>

    <?php endwhile;
    endif;
    ?>

    <?php get_template_part('template-parts/posts/latest-block-posts'); ?>

</main>
<?php

get_footer(); // Include the footer
