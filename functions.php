<?php
/**
 * magic functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package magic
 */

$magic = (object) array(
	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-magic.php',
	'customizer' => require 'inc/customizer/class-magic-customizer.php',
);
require get_template_directory() . '/inc/magic-functions.php';
require get_template_directory() . '/inc/magic-template-hooks.php';
require get_template_directory() . '/inc/magic-template-functions.php';
require get_template_directory() . '/inc/magic-extends.php';

if ( magic_is_woocommerce_activated() ) {
	$magic->woocommerce = require 'inc/woocommerce/class-magic-woocommerce.php';
	require_once 'inc/woocommerce/magic-woocommerce-template-hooks.php';
	require_once 'inc/woocommerce/magic-woocommerce-template-functions.php';
	require_once 'inc/woocommerce/magic-woocommerce-function.php';
}

include_once 'inc/flatsome-add-function-variation-menu.php';

