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

	remove_filter('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_filter( 'woocommerce_get_price_html', 'diviecom_filter_woo_get_price_html', 99 );
function diviecom_filter_woo_get_price_html($value='')
{
	if(is_product()) return '<span>цена </span>' . $value;
	return $value;
}

	/*========================================================
	  *  найти баги урл товаров плитки 
	========================================================*/

	add_action('admin_menu', 'divie_register_wc_submenu_page_url');

function divie_register_wc_submenu_page_url() {
  add_submenu_page( 'edit.php?post_type=product', 'for url', 'for url', 'manage_options', 'access-product-newurl', 'divie_submenu_page_cb' ); 
}

function divie_submenu_page_cb() {
  echo '<div class="wrap"><h3 class="edit-attributes__description">url</h3>';
	$str = '';
$post = get_post( 1299 );
echo do_shortcode($post->post_content);
	$args = array( 
		'p' => '1299',
    'post_type' => array( 'product',
            ),
    'posts_per_page' => -1,                 //(int) - number of post to show per page (available with Version 2.1). Use 'posts_per_page' => -1 to show 

);

$the_query = new WP_Query( $args );

// The Loop
global $post;
if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post();
  var_dump($post->ID);
endwhile;
endif;

// Reset Post Data
wp_reset_postdata();


  echo '</div>';
 
}

