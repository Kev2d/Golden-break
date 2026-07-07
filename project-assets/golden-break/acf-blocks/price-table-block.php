<?php
$title = get_field('title');
$description = get_field('description');
$table_title = get_field('table_title');
$first_column_label = get_field('first_column_label');
$second_column_label = get_field('second_column_label');
$third_column_label = get_field('third_column_label');
$table_note = get_field('table_note');
$clean_price_table_text = static function ($value) {
    $value = trim((string) $value);

    return preg_replace('/^<p>(.*)<\/p>$/s', '$1', $value);
};

if ($title) {
    $title = $clean_price_table_text($title);
}
?>

<section class="price-table-block">
    <div class="price-table-block__inner layout-xl">
        <?php if ($title || $description) : ?>
            <div class="price-table-block__header layout-md">
                <?php if ($title) : ?>
                    <div class="price-table-block__title"><?php echo wp_kses_post($title); ?></div>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <div class="price-table-block__description"><?php echo wp_kses_post($description); ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('table_rows')) : ?>
            <article class="price-table-block__card">
                <?php if ($table_title) :
                    $table_title = $clean_price_table_text($table_title);
                ?>
                    <div class="price-table-block__table-title"><?php echo wp_kses_post($table_title); ?></div>
                <?php endif; ?>

                <div class="price-table-block__table-wrap">
                    <table class="price-table-block__table">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo esc_html($first_column_label); ?></th>
                                <th scope="col"><?php echo esc_html($second_column_label); ?></th>
                                <th scope="col"><?php echo esc_html($third_column_label); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while (have_rows('table_rows')) : the_row();
                                $first_column_text = $clean_price_table_text(get_sub_field('first_column_text'));
                                $second_column_text = $clean_price_table_text(get_sub_field('second_column_text'));
                                $third_column_text = $clean_price_table_text(get_sub_field('third_column_text'));
                            ?>
                                <tr>
                                    <td><?php echo wp_kses_post($first_column_text); ?></td>
                                    <td><?php echo wp_kses_post($second_column_text); ?></td>
                                    <td><?php echo wp_kses_post($third_column_text); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($table_note) : ?>
                    <div class="price-table-block__note"><?php echo wp_kses_post($table_note); ?></div>
                <?php endif; ?>
            </article>
        <?php endif; ?>
    </div>
</section>
