<?php
/**
 * The footer sidebar  containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package magic
 */

if ( ! is_active_sidebar( 'footer-1' ) ) {
	return;
}
?>
	<?php dynamic_sidebar( 'footer-1' ); ?>

