<?php
/*global $post;

add_filter(  'edit_posts_per_page' ,  'filter_function_name_1244' ,  10 ,  2  ) ; 
function filter_function_name_1244 (  $posts_per_page ,  $post_type  ) { 
	global $template;
var_dump('22222222222222222222');
$current_user = wp_get_current_user()->user_login;
var_dump($current_user);
var_dump($posts_per_page);

	return  2; 
}
*/
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'magic_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'magic_cart_link_fragment' );
}