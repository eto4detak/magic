<?php 
/*========================================================
		*	HEADER	Language
		========================================================*/
add_filter( 'locale', 'magic_theme_localized' );
function magic_theme_localized( $locale ){
	if ( isset( $_GET['l'] ) ){
		add_action( 'init', 'magic_setcookie_example' );
		return esc_attr( $_GET['l'] );
	}
	if(isset($_COOKIE['l'])) return esc_attr( $_COOKIE['l']);
	return $locale;
}
 function magic_setcookie_example() {
			setcookie( "l",esc_attr( $_GET['l'] ), time() + (86400 * 30), COOKIEPATH, COOKIE_DOMAIN );
 }


