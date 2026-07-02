<header class="hero-block layout-xl">
    <div class="hero-block__content">

        <?php
        $title = get_field('title');
        $description = get_field('description');
        $button = get_field('button');
        $secondary_button = get_field('secondary_button');

        if ($title) : ?>
            <div class="hero-block__content-title">
                <?php echo $title; ?>
            </div>
        <?php endif; ?>

        <?php if ($description) : ?>
            <div class="hero-block__content-description">
                <?php echo $description; ?>
            </div>
        <?php endif; ?>

        <?php if ($button || $secondary_button) : ?>
            <div class="hero-block__content-buttons">
                <?php
                if ($button) :
                    $link_url = $button['url'];
                    $link_title = $button['title'];
                    $link_target = $button['target'] ? $button['target'] : '_self';
                ?>
                    <a class="hero-block__content-button button--primary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                <?php endif; ?>

                <?php
                if ($secondary_button) :
                    $link_url = $secondary_button['url'];
                    $link_title = $secondary_button['title'];
                    $link_target = $secondary_button['target'] ? $secondary_button['target'] : '_self';
                ?>
                    <a class="hero-block__content-button button--secondary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                <?php endif; ?>
            <?php endif; ?>
            </div>

    </div>

    <div class="hero-block__image">
        <?php
        $image = get_field('image');
        if ($image) : ?>
            <picture>
                <source media="(max-width:<?php echo Theme_Config::get_breakpoint('mobile'); ?>px)" srcset="<?php echo esc_url($image['sizes']['mobile-image']); ?>">
                <source media="(max-width:<?php echo Theme_Config::get_breakpoint('tablet'); ?>px)" srcset="<?php echo esc_url($image['sizes']['tablet-image']); ?>">
                <img loading="eager" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>" />
            </picture>
        <?php endif; ?>
    </div>
</header>

<?php
if (have_rows('cards')) :
    $cards_section_title = get_field('cards_section_title'); ?>
    <section class="hero-cards layout-xl">
        <?php if ($cards_section_title) : ?>
            <h5 class="cards-section-title"><?php echo $cards_section_title; ?></h5>
        <?php endif; ?>

        <div class="hero-cards__cards">
            <?php while (have_rows('cards')) : the_row();
                $card_title = get_sub_field('title');
                $card_description = get_sub_field('description');
                $card_additional_info = get_sub_field('additional_info');
            ?>
                <div class="hero-cards__cards-card">
                    <?php if ($card_title) : ?>
                        <p class="card-title"><?php echo $card_title; ?></p>
                    <?php endif; ?>

                    <?php if ($card_description) : ?>
                        <p class="card-description"><?php echo $card_description; ?></p>
                    <?php endif; ?>

                    <?php if ($card_additional_info) : ?>
                        <p class="card-additional-info"><?php echo $card_additional_info; ?></p>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php endif; ?>