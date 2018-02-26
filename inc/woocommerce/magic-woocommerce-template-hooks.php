<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'woocommerce_before_shop_loop_item', 'magic_slider_wrapper', 5 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'magic_end_slider_wrapper',20 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	/*========================================================
			*	Loop
			========================================================*/
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'magic_template_loop_product_title',10 );

	add_action( 'woocommerce_after_shop_loop_item_title', 'magic_template_wrapper_price', 8 );
	add_action( 'woocommerce_after_shop_loop_item', 'magic_template_wrapper_price_end', 20 );
	add_action( 'woocommerce_after_shop_loop_item', 'magic_template_loop_variation_attributs', 30 );

/*========================================================
		*		Cart
		========================================================*/
add_action( 'woocommerce_before_calculate_totals', 'magic_add_custom_price' );

/*========================================================
		*		Order
		========================================================*/
add_action( 'woocommerce_new_order', 'action_woocommerce_new_order', 10, 1 ); 


/*========================================================
		*		ALL
		========================================================*/

add_action('magic_header', 'magic_header_cart', 20);
add_filter('woocommerce_sale_flash', 'magic_woocommerce_sale_flash', 20);

/*========================================================
		*		CARD
		========================================================*/

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text', 30 );
 ?>