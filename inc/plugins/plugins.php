<?php 
	/*========================================================
	  *  Media File Renamer   -- замена имен кортинок 
	========================================================*/
	function wp_ajax_mfrh_rename_media() {
function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        ' ' => '-'
    );
    return strtr($string, $converter);
}



    global $product;

    $args = array( 
    'post_type' =>  'product',
    'posts_per_page' => -1,       
    // 'product_cat' => 'westerwalder-klinker',
    // 'product_cat' => 'tiileri',
    // 'product_cat' => 'stroeher',
    // 'product_cat' => 'roben',
    // 'product_cat' => 'rijswaard',
    // 'product_cat' => 'paradyz',
    // 'product_cat' => 'nelissen',
    // 'product_cat' => 'muhr',
    // 'product_cat' => 'lode',
    // 'product_cat' => 'klinkerhause',
    // 'product_cat' => 'klinker-werk',
    // 'product_cat' => 'interbau',
    // 'product_cat' => 'feldhaus-klinker',
    // 'product_cat' => 'euramic',
    // 'product_cat' => 'crinitz',
    // 'product_cat' => 'crh',
    // 'product_cat' => 'cerrad',   
    // 'product_cat' => 'abc',   
    'product_cat' => 'klinkernye-termopaneli',   
   // 'orderby' => 'rand',
    'post_status' =>  'publish',      
	);
	$the_query = new WP_Query( $args );
	$str = [];

$counter_w = 1;
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
global $post, $product;
		//$this->core->rename( 973, 'product_woo' );
		// get_id_woocom22();
$product_woo = $post;
		$number_id = $product_woo->ID;
		// $str[] = $post->post_name;
		$media = get_post_thumbnail_id( $number_id );
		//$str[] = $media;
		if(!$media) continue;
	//	$str[] = $media . '+';
		$product_image_gallery = get_post_meta( $number_id, '_product_image_gallery', true );
		$attachments         = array_filter( explode( ',', $product_image_gallery ) );

		$attachments = array_diff($attachments, array($media));
		
		$url = wp_get_attachment_image_url( $media);
	   $exp = '.' .	end(explode(".", $url));
	 //  vardump( $product_woo->name . $exp);
			$str[] = $post->post_title . $exp;
			$new_name =  $post->post_title . $exp;
			$new_name = rus2translit($new_name);
		 $this->core->rename( $media, $new_name);
		// $this->core->rename( $media, $post->post_title . $exp);
		// $this->core->rename( $media, 'tt-woo-' . $counter_w . '.jpg');
		// $this->core->rename( $media, 'ee_woo-' . $counter_w );

		 $counter = 2;
		//if($counter_w > 224) break;
		 foreach ($attachments as  $attach) {
		 $url = wp_get_attachment_image_url( $attach);
	   $exp = '.' .	end(explode(".", $url));

		 	if($counter > 10) $counter = $counter;
		 	else $counter =  '0' . $counter;
		 	// vardump( $product_woo->post_title . '-' . $counter . $exp);
		 	$str[] = $product_woo->post_title . '-' . $counter . $exp;
		 	$new_name =  $product_woo->post_title . '-' . $counter . $exp;
			$new_name = rus2translit($new_name);

		 	 $this->core->rename( $attach, $new_name);
		 	// $this->core->rename( $attach, $product_woo->post_title . '-' . $counter . $exp);
			$counter++;
		 	$counter_w++;
		 }
	endwhile;
	endif;
	//wp_reset_postdata();
		echo json_encode($str);;

   
		// $subaction = $_POST['subaction'];
		// if ( $subaction == 'getMediaIds' ) {
		// 	$all = intval( $_POST['all'] );
		// 	global $wpdb;
		// 	$ids = $wpdb->get_col( "SELECT p.ID FROM $wpdb->posts p WHERE post_status = 'inherit' AND post_type = 'attachment'" );
		// 	if ( !$all ) {
		// 		$idsToRemove = $wpdb->get_col( "SELECT m.post_id FROM $wpdb->postmeta m
		// 			WHERE m.meta_key = '_manual_file_renaming' and m.meta_value = 1" );
		// 		$ids = array_values( array_diff( $ids, $idsToRemove ) );
		// 	}
		// 	else {
		// 		// We rename all, so we should unlock everything.
		// 		$wpdb->query( "DELETE FROM $wpdb->postmeta WHERE meta_key = '_manual_file_renaming'" );
		// 	}
		// 	$reply = array();
		// 	$reply['ids'] = $ids;
		// 	$reply['total'] = count( $ids );
		// 	echo json_encode( $reply );
		// 	die;
		// }
		// else if ( $subaction == 'renameMediaId' ) {
		// 	$id = intval( $_POST['id'] );
		// 	$newName = array_key_exists( 'newName', $_POST ) ? $_POST['newName'] : null;
		// 	if ( isset( $newName ) ) { // Manual Rename
		// 		if ( !$this->admin->is_registered() ) {
		// 			wp_send_json_error( __( 'This feature is for Pro users only', 'media-file-renamer' ) );
		// 		} else if ( !get_option( 'mfrh_manual_rename' ) ) {
		// 			wp_send_json_error( __( 'You need to enable Manual Rename in the plugin settings', 'media-file-renamer' ) );
		// 		}
		// 	}
		// 	$this->core->rename( $id, $newName );
		// 	wp_send_json_success( basename( get_attached_file( $id ) ) );
		// }

		die();
	}