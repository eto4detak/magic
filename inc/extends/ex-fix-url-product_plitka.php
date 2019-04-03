<?php 

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


// $pos = strrpos('http:wpmagiccproducttovarr', 'tovarr');
// if ($pos === false) { // обратите внимание: три знака равенства
// 		echo('   ===  ');
// 		echo('<br>');
// }else{

// 		echo('####<br>');
// }

if(0){
	$var_url = 1051;
		 $url = get_permalink( $var_url);
		// $ur =  get_sample_permalink( $post->ID);
		$url_e =  div_ee( $var_url);

		var_dump($url);
		var_dump('   ===  ');
		var_dump($url_e);
		var_dump(' +++<br>');
		// var_dump($ur);
		// var_dump($view_link);
		// var_dump('<br>');
		//  $url_3 = substr($url, -3);
		//  if($url_3 === '-2/'){
		//  	   $str .=  $url . PHP_EOL;
		// var_dump($url);
		// var_dump('<br>');
		//  }else if(substr($url, -2)=== '-2'){
		//  	$str .=  $url . PHP_EOL;
		//  }

}

if(1){
	$args = array( 
	    'post_type' => array(  'product',  ),
	    'posts_per_page' => -1,    
	);
	$the_query = new WP_Query( $args );
	global $post;

	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();

	  
	 $url = get_permalink( $post->ID);
	 $url = wp_unslash( $url );
	 // $url = str_ireplace('/', "", $url);
	// $ur =  get_sample_permalink( $post->ID);
	$url_e =  div_ee( $post->ID);
	$url_e = wp_unslash( $url_e );
	// $url_e = str_ireplace('/', "", $url_e);
	// $pos      = strripos($url, $url_e);
$pos = strrpos($url, $url_e);
if ($pos === false) { // обратите внимание: три знака равенства
	$url_2 = substr($url_e, -2);
	if($url_2 === '-2'){
		   				echo($url);
		echo('   ===  ' . $post->ID . ' === ');
		echo($url_e);
		echo('<br>');
	}

}else{
	 //  echo($url);
		// echo('   ===  ');
		// echo($url_e);
		// echo('####<br>');
}

	// if ($pos > -1) {

	//     echo "-----";
	//     echo '<br>';
	// } else {
	// 			var_dump($url);
	// 	var_dump('   ===  ');
	// 	var_dump($url_e);
	// 	var_dump('<br>');
	// }
// 	list($permalink, $post_name) = get_sample_permalink($post->ID, NULL,NULL);

// 	$view_link = false;
// 	$preview_target = '';

// 	if ( current_user_can( 'read_post', $post->ID ) ) {
// 		if ( 'draft' === $post->post_status || empty( $post->post_name ) ) {
// 			$view_link = get_preview_post_link( $post );
// 			$preview_target = " target='wp-preview-{$post->ID}'";
// 		} else {
// 			if ( 'publish' === $post->post_status || 'attachment' === $post->post_type ) {
// 				$view_link = get_permalink( $post );
// 			} else {
// 				// Allow non-published (private, future) to be viewed at a pretty permalink, in case $post->post_name is set
// 				$view_link = str_replace( array( '%pagename%', '%postname%' ), $post->post_name, $permalink );
// 			}
// 		}
// 	}
// $view_link = str_replace( array( '%pagename%', '%postname%' ), $post->post_name, $permalink );

	// var_dump($url);
	// var_dump('   ===  ');
	// var_dump($url_e);
	// var_dump('<br>');
	// var_dump($ur);
	// var_dump($view_link);
	// var_dump('<br>');
	//  $url_3 = substr($url, -3);
	//  if($url_3 === '-2/'){
	//  	   $str .=  $url . PHP_EOL;
	// var_dump($url);
	// var_dump('<br>');
	//  }else if(substr($url, -2)=== '-2'){
	//  	$str .=  $url . PHP_EOL;
	//  }

// $url_new = str_ireplace('<a href="', '', $url_e);
// 	 if($url !== $url_e){
// 	 	   // $str .=  $url . PHP_EOL;
// 		echo($url);
// 		echo('   ===  ');
// 		echo($url_e);
// 		echo('<br>');
// 	 }

	// if($url !== $view_link){
	// 	 $str .=  $url . PHP_EOL;
	// }

	endwhile;
	endif;
	wp_reset_postdata();

// var_dump($str);
	// $file = "all-url-2.txt";

	// if (!file_exists($file)) {
	//     $fp = fopen($file, "w"); 
	//     fwrite($fp, $str);
	//     fclose($fp);
	// }
}

  echo '</div>';
 
}


function div_ee( $id, $new_title = null, $new_slug = null ) {
	$post = get_post( $id );
	if ( ! $post )
		return '';

	list($permalink, $post_name) = get_sample_permalink($post->ID, $new_title, $new_slug);

	$view_link = false;
	$preview_target = '';

	if ( current_user_can( 'read_post', $post->ID ) ) {
		if ( 'draft' === $post->post_status || empty( $post->post_name ) ) {
			$view_link = get_preview_post_link( $post );
			$preview_target = " target='wp-preview-{$post->ID}'";
		} else {
			if ( 'publish' === $post->post_status || 'attachment' === $post->post_type ) {
				$view_link = get_permalink( $post );
			} else {
				// Allow non-published (private, future) to be viewed at a pretty permalink, in case $post->post_name is set
				$view_link = str_replace( array( '%pagename%', '%postname%' ), $post->post_name, $permalink );
			}
		}
	}

	// Permalinks without a post/page name placeholder don't have anything to edit
	if ( false === strpos( $permalink, '%postname%' ) && false === strpos( $permalink, '%pagename%' ) ) {
		$return = '<strong>' . __( 'Permalink:' ) . "</strong>\n";

		if ( false !== $view_link ) {
			$display_link = urldecode( $view_link );
			$return .= '<a id="sample-permalink" href="' . esc_url( $view_link ) . '"' . $preview_target . '>' . esc_html( $display_link ) . "</a>\n";
		} else {
			$return .= '<span id="sample-permalink">' . $permalink . "</span>\n";
		}

		// Encourage a pretty permalink setting
		if ( '' == get_option( 'permalink_structure' ) && current_user_can( 'manage_options' ) && !( 'page' == get_option('show_on_front') && $id == get_option('page_on_front') ) ) {
			$return .= '<span id="change-permalinks"><a href="options-permalink.php" class="button button-small" target="_blank">' . __('Change Permalinks') . "</a></span>\n";
		}
	} else {
		if ( mb_strlen( $post_name ) > 34 ) {
			$post_name_abridged = mb_substr( $post_name, 0, 16 ) . '&hellip;' . mb_substr( $post_name, -16 );
		} else {
			$post_name_abridged = $post_name;
		}

		$post_name_html = '<span id="editable-post-name">' . esc_html( $post_name_abridged ) . '</span>';
		$display_link = str_replace( array( '%pagename%', '%postname%' ), $post_name_html, esc_html( urldecode( $permalink ) ) );

		$return = '<strong>' . __( 'Permalink:' ) . "</strong>\n";
		$return .= '<span id="sample-permalink"><a href="' . esc_url( $view_link ) . '"' . $preview_target . '>' . $display_link . "</a></span>\n";
		$return .= '&lrm;'; // Fix bi-directional text display defect in RTL languages.
		$return .= '<span id="edit-slug-buttons"><button type="button" class="edit-slug button button-small hide-if-no-js" aria-label="' . __( 'Edit permalink' ) . '">' . __( 'Edit' ) . "</button></span>\n";
		$return .= '<span id="editable-post-name-full">' . esc_html( $post_name ) . "</span>\n";


			$return =  esc_url( $view_link ) . '"' . $preview_target . '>' . $display_link . "</a></span>\n";
			$return =  esc_html( $post_name_abridged );
	}
$return = $post_name_abridged ;
	/**
	 * Filters the sample permalink HTML markup.
	 *
	 * @since 2.9.0
	 * @since 4.4.0 Added `$post` parameter.
	 *
	 * @param string  $return    Sample permalink HTML markup.
	 * @param int     $post_id   Post ID.
	 * @param string  $new_title New sample permalink title.
	 * @param string  $new_slug  New sample permalink slug.
	 * @param WP_Post $post      Post object.
	 */
	// $return = apply_filters( 'get_sample_permalink_html', $return, $post->ID, $new_title, $new_slug, $post );

	return $return;
}
 ?>