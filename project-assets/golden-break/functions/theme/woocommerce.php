<?php

function golden_break_simplify_checkout_fields($fields)
{
    $unused_billing_fields = array(
        'billing_company',
        'billing_address_1',
        'billing_address_2',
        'billing_city',
        'billing_state',
        'billing_postcode',
    );

    foreach ($unused_billing_fields as $field_name) {
        unset($fields['billing'][$field_name]);
    }

    if (isset($fields['billing']['billing_country'])) {
        $fields['billing']['billing_country']['type'] = 'hidden';
        $fields['billing']['billing_country']['default'] = 'EE';
    }

    unset($fields['order']['order_comments']);

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'golden_break_simplify_checkout_fields', 20);

function golden_break_checkout_country($country)
{
    return 'EE';
}
add_filter('default_checkout_billing_country', 'golden_break_checkout_country', 20);

function golden_break_checkout_posted_country($data)
{
    $data['billing_country'] = 'EE';

    return $data;
}
add_filter('woocommerce_checkout_posted_data', 'golden_break_checkout_posted_country');

add_filter('woocommerce_enable_order_notes_field', '__return_false');
