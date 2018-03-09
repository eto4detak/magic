<?php 
/**
 * Magic  functions.
 *
 * @package Magic
 */

if ( ! function_exists( 'magic_is_woocommerce_activated' ) ) {
	/**
	 * Query WooCommerce activation
	 */
	function magic_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

function magic_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}

