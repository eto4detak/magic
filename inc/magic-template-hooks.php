<?php 
add_filter( 'body_class', 'magic_body_classes' );
add_action( 'wp_head', 'magic_pingback_header' );