<?php
$booking_button = function_exists('get_field') ? get_field('booking_button', 'option') : null;
$cta_label = !empty($booking_button['title']) ? $booking_button['title'] : __('Broneeri laud', 'golden-break');
$cta_url = !empty($booking_button['url']) ? $booking_button['url'] : home_url('/broneerimine/');
$cta_target = !empty($booking_button['target']) ? $booking_button['target'] : '_self';
?>

<a class="header-booking-cta" href="<?php echo esc_url($cta_url); ?>" target="<?php echo esc_attr($cta_target); ?>">
    <?php echo esc_html($cta_label); ?>
</a>
