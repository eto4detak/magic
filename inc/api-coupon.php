<?php
$data = [
    'code' => '10off',
    'discount_type' => 'percent',
    'amount' => '10',
    'individual_use' => true,
    'exclude_sale_items' => true,
    'minimum_amount' => '100.00'
];
global $woocommerce;
var_dump($woocommerce);
$woocommerce->post('coupons', $data);
?>