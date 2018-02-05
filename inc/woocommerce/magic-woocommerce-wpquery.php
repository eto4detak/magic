<?php 

	$query->set( 'meta_key' , '_is_constructor_product');


	global $wp_query, $pagenow;
	$wp_query->query_vars = $wp_query->query_vars + 	 array(
	'meta_query' => array(
		array(
			'key'     => '_visibility',
			'value'   => '',
		)
	)
);
	$query->parse_query_vars();

	var_dump($query);





