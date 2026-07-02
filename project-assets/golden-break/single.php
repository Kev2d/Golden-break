<?php get_header(); ?>

<main class="single-blog layout-xl">

    <?php
    if (class_exists('Breadcrumbs')) {
        Breadcrumbs::render();
    }
    ?>

    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            $excerpt = has_excerpt() ? get_the_excerpt() : '';
            $content = get_the_content();
            $word_count = str_word_count(strip_tags($content));
            $read_time = max(1, ceil($word_count / 200));
            $categories = get_the_category();

            // Retrieve featured image details
            $image_id = get_post_thumbnail_id(get_the_ID());
            $image_full = wp_get_attachment_image_src($image_id, 'full');
            $image_mobile = wp_get_attachment_image_src($image_id, 'mobile-image');
            $image_tablet = wp_get_attachment_image_src($image_id, 'tablet-image');
    ?>

            <article class="single-blog__post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="single-blog__post-header">
                    <h1 class="single-blog__post-title"><?php the_title(); ?></h1>

                    <?php if ($excerpt) : ?>
                        <p class="single-blog__post-excerpt"><?php echo $excerpt; ?></p>
                    <?php endif; ?>

                    <div class="single-blog__post-meta">
                        <span class="author"><?php _e('By', 'keweb'); ?> <?php the_author(); ?></span>
                        <time class="date" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        <span class="read-time">- <?php echo $read_time; ?> <?php _e('min read', 'keweb'); ?></span>
                    </div>

                    <div class="single-blog__post-categories">
                        <?php foreach ($categories as $category) : ?>
                            <span class="category category-tag">
                                <?php echo esc_html($category->name); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </header>

                <?php if ($image_full) : ?>
                    <figure class="single-blog__post-featured-image">
                        <picture>
                            <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile'); ?>px)" srcset="<?php echo esc_url($image_mobile[0]); ?>">
                            <source media="(max-width:<?php echo Theme_Config::get_breakpoint('tablet'); ?>px)" srcset="<?php echo esc_url($image_tablet[0]); ?>">
                            <img
                                src="<?php echo esc_url($image_full[0]); ?>"
                                alt="<?php the_title_attribute(); ?>"
                                width="<?php echo esc_attr($image_full[1]); ?>"
                                height="<?php echo esc_attr($image_full[2]); ?>">
                        </picture>
                    </figure>
                <?php endif; ?>

                <div class="single-blog__post-content">
                    <?php the_content(); ?>
                </div>

            </article>
    <?php
        endwhile;
    endif;
    ?>

    <?php get_template_part('template-parts/posts/suggested-posts'); ?>

</main>

<?php get_footer(); ?>