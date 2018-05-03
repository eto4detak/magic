<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$path = get_template_directory() . '/inc/extends/';
$path_woocommerce = get_template_directory() . '/inc/woocommerce/';

require_once $path . 'theme-options.php';   //доп страницы и поля, опции, redux опции
require_once $path . 'carbon_options.php';  //поля плагина карбон
require_once $path . 'frontend.php';				//фронтенд
require_once $path . 'magic-breadcrumbs.php';//хлебные крошки
require_once $path . 'init-tgm.php';				//плагин tgm
require_once $path . 'customizer.php';			//кастомайзер
require_once $path . 'custom-header.php';
require_once $path . 'template-tags.php';
include $path . '_test.php';
// require_once $path . 'ex-metabox-address.php';
// require_once $path . 'ex-menu-taxonomy.php';
//require_once $path . 'ex-api-dollors-rubli.php';
if ( defined( 'JETPACK__VERSION' ) ) {
	require $path . 'jetpack.php';
}

/*========================================================
 		*		HTTP API 
========================================================*/
//require_once  $path  . 'magic-http-api.php';
// require_once $path . 'magic-rest-api.php';
require_once $path . 'ex-api-polis.php';

/*========================================================
		*		WooCommerce
========================================================*/
require_once $path_woocommerce . 'magic-woocomerce-h.php';
require_once $path_woocommerce . 'magic-woocommerce-template-add-field-to-product.php';
// require_once $path_woocommerce . 'magic-coupon.php';
// require_once $path_woocommerce . 'magic-http-api-woocommerce.php';
// require_once $path_woocommerce . 'magic-woocomerce-rubli.php';
// require_once $path_woocommerce . 'magic-woocomerce-add-order.php';


