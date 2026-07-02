<?php
$slider_id_attr = isset($args['slider_id']) && !empty($args['slider_id']) ? 'aria-controls="' . esc_attr($args['slider_id']) . '"' : '';
?>

<div class="content-controls">
    <div class="content-controls__wrapper">
        <button class="content-controls__button content-controls__button--prev content-controls-prev" aria-label="<?php _e('Previous', 'golden-break'); ?>" <?php echo $slider_id_attr; ?>>
            <?php GetSvg::import('/assets/img/icons/chevron-left.svg'); ?>
        </button>

        <div class="content-controls__pagination content-controls-pagination" aria-live="polite" <?php echo $slider_id_attr; ?>>
        </div>

        <button class="content-controls__button content-controls__button--next content-controls-next" aria-label="<?php _e('Next', 'golden-break'); ?>" <?php echo $slider_id_attr; ?>>
            <?php GetSvg::import('/assets/img/icons/chevron-right.svg'); ?>
        </button>
    </div>
</div>