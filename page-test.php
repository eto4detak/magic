
<?php
/*
Template Name: ТЕСТОВАЯ СТРАНИЦА
Template Post Type: post, page
*/

get_header();
if( is_page_template( 'page-test.php' )) echo "<div>11111</div><br>";


 ?>

<!-- <input type='file' accept='text/plain' onchange='openFile(event)'><br>
<img id='output'> -->

<?php 

 ?>
<form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
	<input type="file" name="my_image_upload" id="my_image_upload" accept=".txt"  multiple="false" />
	<input type="hidden" name="post_id" id="post_id" value="0" />
	<?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
	<input id="submit_my_image_upload" name="submit_my_image_upload" type="submit" value="Upload" />
</form>
<?php 
// wp_list_categories();

$terms = get_terms( 'category', array(
	'hide_empty' => false,
) );
if(!empty($terms)){
	echo '<select class="select-cat">';
	echo '<option class="option-cat" value="">Выбрать рубрику</option>';
	foreach ($terms as $term) {
		echo '<option class="option-cat" value="' . $term->slug . '">' . $term->name . '</option>';
	}
	echo '</select>';
}

 ?>

<?php
	function vardump($var) {
	  echo '<pre>';
	  var_dump($var);
	  echo '</pre>';
	}
	function extend_theme64562436_update_post($value='')
	{
		// vardump('extend_theme64562436=' . $value);
		if(!$value) return;
		global $post;
		$get  = mb_detect_encoding($value, array('utf-8', 'cp1251'));
    $str = iconv($get,'UTF-8',$value);
    if(empty($post->post_content)){

		  $my_post = array();
			$my_post['ID'] = $post->ID;
			$my_post['post_content'] = $str;
			wp_update_post( wp_slash($my_post) );
			vardump('<br>id='. $post->ID . ' val= ' . $str . '<br>');
    }
	}

	global $post;

	if ( 
	isset( $_POST['my_image_upload_nonce'], $_POST['post_id'] ) 
	 && wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
	 && ($_FILES['my_image_upload']['type'] === "text/plain")
	// && current_user_can( 'edit_post', $_POST['post_id'] )
	) {
		// все ок! Продолжаем.
		// Эти файлы должны быть подключены в лицевой части (фронт-энде).
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );

		// Позволим WordPress перехватить загрузку.
		// не забываем указать атрибут name поля input - 'my_image_upload'
		$attachment_id = media_handle_upload( 'my_image_upload', 0 );
		$url = get_attached_file( $attachment_id );
		$titles = file($url);
//vardump('titles = ' . $titles[0]);
	/*========================================================
	  *  
	========================================================*/
	$args = array( 
	  'post_type' => array('post' ),
	  'post_status' => array(      
            'publish',                      // - a published post or page.
            'pending',                      // - post is pending review.
            'draft',                        // - a post in draft status.
            'auto-draft',                   // - a newly created post, with no content.
            'future',                       // - a post to publish in the future.
            'private',                      // - not visible to users who are not logged in.
            ),
	  'posts_per_page' => -1,
	  'category_name' => 'auto, mobil',
	);
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();
			//echo '<br>$post->post_content=' . $post->post_content . '<br>';
			if(!$post->post_content){
				$str = array_shift($titles);
			//	vardump('$str=' .  $str);
				if(!empty($str)) extend_theme64562436_update_post($str);
				// vardump($post);
			}
		endwhile;
	endif;
	// Reset Post Data
	wp_reset_postdata();


		// foreach ($titles as  $value) {
		// 	$get  = mb_detect_encoding($value, array('utf-8', 'cp1251'));
	 //    $str = iconv($get,'UTF-8',$value);
	 //    if($post->post_content){

		// 	  $my_post = array();
		// 		$my_post['ID'] = $post->ID;
		// 		$my_post['post_content'] = ;
		// 		wp_update_post( wp_slash($my_post) );
	 //    }
		// 	echo  '<br>';
		// }
		// $attachment_id = media_handle_upload( 'my_image_upload', $_POST['post_id'] );

		if ( is_wp_error( $attachment_id ) ) {
			echo "Ошибка загрузки медиафайла.";
		} else {
			echo "Медиафайл был успешно загружен!";
		}
		// unlink($_FILES['my_image_upload']);
		// var_dump($_FILES['my_image_upload']);
		unset($_FILES['my_image_upload']);
		// var_dump('========================');
		// var_dump($_FILES['my_image_upload']);

	} else {
		echo "Проверка не пройдена. Невозможно загрузить файл.";
	}








	//get_sidebar();
	//get_footer();


 

