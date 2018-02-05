<?php 
if ( ! function_exists( 'magic_is_woocommerce_activated' ) ) {

	function magic_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}


