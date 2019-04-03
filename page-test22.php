
<?php
/*
Template Name: новая ТЕСТОВАЯ СТРАНИЦА
Template Post Type: post, page
*/

get_header();
if( is_page_template( 'page-test.php' )) echo "<div>11111</div><br>";







// post_add_content_update_all22(1280);
// // post_add_content_update_all22(1276);
// // post_add_content_update_all22(1278);
// // post_add_content_update_post22('1 строка 2');
// 	function post_add_content_update_all22($attachment_id='')
// 	{
// 		global $post;
// 		$url = get_attached_file( $attachment_id );
// 		$titles = file($url);
// 			$args = array( 
// 	  'post_type' => array('product' ),
// 	  'post_status' => array(      
//             'publish',                      // - a published post or page.
//             'pending',                      // - post is pending review.
//             'draft',                        // - a post in draft status.
//             'auto-draft',                   // - a newly created post, with no content.
//             'future',                       // - a post to publish in the future.
//             'private',                      // - not visible to users who are not logged in.
//             ),
// 	  'posts_per_page' => -1,
// 	  'product_cat' => $_POST['tax'],
// 	);
// 	$the_query = new WP_Query( $args );
// $counter_post = 0;
// 	if ( $the_query->have_posts() ) :
// 		while ( $the_query->have_posts() ) : $the_query->the_post();
// 			if(!$post->post_content){
// 				$str = array_shift($titles);
// 				if(!empty($str)){
// 					post_add_content_update_post22($str);
// 					$counter_post++;
// 				} 
// 			}
// 		endwhile;
// 	endif;
// 	// Reset Post Data
// 	wp_reset_postdata();
// 	return $counter_post;
// 	}

// 	function post_add_content_update_post22($value='')
// 	{
// 		if(!$value) return;
// 		global $post;
// 		// echo '1:' . $value;
// 		$get  = mb_detect_encoding($value, array('utf-8', 'cp1251'));
// 		// echo '2:' . $get;
//     // $str = iconv($get,'UTF-8',$value);
//     $str = iconv('CP1251','UTF-8',$value);
//     echo '3: ' . $str . '<br>';
//     if(empty($post->post_content)){

// 		  $my_post = array();
// 			$my_post['ID'] = $post->ID;
// 			$my_post['post_content'] = $str;
// 			// wp_update_post( wp_slash($my_post) );
//     }
// 	}





	//get_sidebar();
	get_footer();


 

