<?php 
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function magic_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}

