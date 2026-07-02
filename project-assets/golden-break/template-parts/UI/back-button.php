<?php
$function = isset($args['function']) ? $args['function'] : '';
$text = isset($args['text']) ? $args['text'] : __('Back', 'golden-break');
$label = isset($args['label']) ? $args['label'] : __('Go back', 'golden-break');
?>
<button class="back-button" aria-label="<?php echo esc_attr($label); ?>" <?php echo $function ? 'data-function="' . esc_attr($function) . '"' : ''; ?>>
    <?php GetSvg::import('/assets/img/icons/arrow-left.svg'); ?>
    <?php echo esc_html($text); ?>
</button>