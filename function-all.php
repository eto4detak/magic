<?php 
//include_once 'inc/flatsome-add-function-variation-menu.php';

// function search_filter($query) {
// //var_dump('================');
// //var_dump($query);
// //var_dump(qwertyyu());
// //var_dump('%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%');
//   //if ( ! is_admin() && $query->is_main_query() ) {
// 	$terms = array('smart', 'term-slug-two', 'term-slug-three');
// 	//&& ! is_user_logged_in()
//   if ( ! is_admin() ) {
// 	//if ($query->is_search) {
// 	 // $query->set('post_type', 'post');
// 	  $query->set( 'tax_query', array([ 			'taxonomy' => 'product_cat',
// 			'field'    => 'slug',
// 			'terms'    => $terms,
// 			'operator' => 'NOT IN'] ));
// 	 // $query->set( 'tax_query', array([ 'product_cat' => 'smart' ]) );
// 	  //$query->set( 'meta_query', array([ 'key'=>'__ПОЛЕ__', 'compare'=>'NOT EXISTS' ]); );
// 	//}
//  }
// }

function accesspress_woocommerce_exclude_cat($query) {
	$exclude_terms =[];
	$args = array(
	'taxonomy' => 'product_cat',
	'hide_empty' => false,
);
$terms = get_terms( $args );
foreach ($terms as $key => $value) {
 if(carbon_get_term_meta( $value->term_id, 'crb_exclude_cat' )){
 	$exclude_terms[] = $value->slug;
 }
}

  if ( ! is_admin() && ! is_user_logged_in() ) {
	 // $query->set( 'posts_per_page', 5);
	  $query->set( 'tax_query', array(['taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $exclude_terms,
			'operator' => 'NOT IN'] ));
 }
}



add_action( 'pre_get_posts', 'accesspress_woocommerce_exclude_cat' );
//global $taxonomies;
 function qwertyyu($value='')
{

	var_dump($taxonomies);
	// in_array( 'product_cat', $taxonomies ) &&
	 if ( ! is_admin() && is_shop() ) {

    foreach ( $terms as $key => $term ) {

      if ( ! in_array( $term->term_id, array( 18  ) ) ) {

        $new_terms[] = $term;
      }

    }

    $terms = $new_terms;
  }

  return $terms;
}
// var_dump('================');
// global $wp_q
// var_dump(search_filter());
// //var_dump(qwertyyu());
// var_dump('%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%');




	/*========================================================
	  *  
	========================================================*/
	//remove_action( 'woocommerce_register_form_start', 'add_name_input'  );
	//$class = new WooCommerce_Simple_Registration;
	//remove_action( 'the_content', array( $class, 'add_name_input' ) );
//remove_action( 'plugins_loaded', 'WooCommerce_Simple_Registration' );


// add_filter( 'woocommerce_short_description', 'filter_woocommerce_short_description', 10, 1 ); 
// function filter_woocommerce_short_description( $post_post_excerpt ) { 
//     // Применяйте свою регулярку к $post_post_excerpt здесь
//     return 'qwrwqrrwqrwqrwqrw'; 
// };



	add_action('register_form','show_fields');
add_action('register_post','check_fields',10,3);
add_action('user_register', 'register_fields');
 
function show_fields() {
/* добавляем поля "Город" и "Номер сотового" в форму регистрации в WordPress */ 
?>

<p>
	<label>ИП / ООО / Название организации: <br/>
	<input id="name_organiz" class="input" type="text" value="<?php echo $_POST['name_organiz']; ?>" name="name_organiz" /></label>
</p>
<p>
	<label>Город в котором осуществляется торговая деятельность: <br/>
	<input id="city" class="input" type="text" value="<?php echo $_POST['city']; ?>" name="city" /></label>
</p>
<p>
	<label>Информация о торговых точках (название и адрес ТЦ, ассортимент м/ж):<br/>
	<input id="user_info" class="input" type="text" value="<?php echo $_POST['user_info']; ?>" name="user_info" /></label>
</p>
<p>
	<label>ИНН (для РБ - УНП):<br/>
	<input id="user_inn" class="input" type="text" value="<?php echo $_POST['user_inn']; ?>" name="user_inn" /></label>
</p>
<p>
	<label>Контактный телефон:<br/>
	<input id="mobile" class="input" type="text" value="<?php echo $_POST['mobile']; ?>" name="mobile" /></label>
</p>


<?php }
 
function check_fields ( $login, $email, $errors ) {
	/* 
	 * Функция проверки полей, в этом примере только смотрит, чтобы они не оставались пустыми, 
	 * но можно задать и свои условия,
	 * например запретить пользователям регистрироваться под одним и тем же номером телефона
	 */
	global $city, $mobile, $name_organiz, $user_info, $user_inn;
	if ($_POST['city'] == ''){
		$errors->add( 'empty_realname', "ОШИБКА: Город?" );
	} else {
		$city = $_POST['city'];
	}
	if ($_POST['mobile'] == ''){
		$errors->add( 'empty_realname', "ОШИБКА: Номер телефона?" );
	} else {
		$mobile = $_POST['mobile'];
	}
	if ($_POST['name_organiz'] == ''){
		$errors->add( 'empty_realname', "ОШИБКА: Название оргранизации?" );
	} else {
		$name_organiz = $_POST['name_organiz'];
	}

	if ($_POST['user_info'] == ''){
		$errors->add( 'empty_realname', "ОШИБКА: Информация о торговых точках ?" );
	} else {
		$user_info = $_POST['user_info'];
	}

	if ($_POST['user_inn'] == ''){
		$errors->add( 'empty_realname', "ОШИБКА: ИНН?" );
	} else {
		$user_inn = $_POST['user_inn'];
	}

	return $errors;
}
 
function register_fields($user_id,$password= "",$meta=array()){
	update_user_meta( $user_id, 'city', $_POST['city'] );
	update_user_meta( $user_id, 'mobile', $_POST['mobile'] );
	update_user_meta( $user_id, 'name_organiz', $_POST['name_organiz'] );
	update_user_meta( $user_id, 'user_info', $_POST['user_info'] );
	update_user_meta( $user_id, 'user_inn', $_POST['user_inn'] );
}










function show_profile_fields( $user ) { ?> 
 	<h3>Дополнительная информация</h3>
 	<!-- добавляется ещё один блок в профиле, в примере он будет называться "Дополнительная информация" -->
 	<table class="form-table">
 	<!-- для того чтобы ваши поля выглядели так же, как и стандартные в WordPress, прописывайте такие же классы как и тут -->
 	<!-- добавляем поле город -->


 	 	<tr><th><label for="name_organiz">ИП / ООО / Название организации:</label></th>
 	<td><input type="text" name="name_organiz" id="name_organiz" value="<?php echo esc_attr(get_the_author_meta('name_organiz',$user->ID));?>" class="regular-text" /><br /></td></tr>
 	 	<tr><th><label for="user_inn">ИНН (для РБ - УНП):</label></th>
 	<td><input type="text" name="user_inn" id="user_inn" value="<?php echo esc_attr(get_the_author_meta('user_inn',$user->ID));?>" class="regular-text" /><br /></td></tr>
 	 	<tr><th><label for="user_info">Информация о торговых точках</label></th>
 	<td><input type="text" name="user_info" id="user_info" value="<?php echo esc_attr(get_the_author_meta('user_info',$user->ID));?>" class="regular-text" /><br /></td></tr>

 	 	<tr><th><label for="city">Город</label></th>
 	<td><input type="text" name="city" id="city" value="<?php echo esc_attr(get_the_author_meta('city',$user->ID));?>" class="regular-text" /><br /></td></tr>
 	<tr><th><label for="mobile">Мобильный</label></th>
 	<td><input type="text" name="mobile" id="mobile" value="<?php echo esc_attr(get_the_author_meta('mobile',$user->ID));?>" class="regular-text" /><br /></td></tr>
 	<!-- закрываем теги и применяем функцию -->
 	</table>
 <?php }
add_action( 'show_user_profile', 'show_profile_fields' );
add_action( 'edit_user_profile', 'show_profile_fields' );

function save_profile_fields( $user_id ) {
	update_usermeta( $user_id, 'city', $_POST['city'] );
	update_usermeta( $user_id, 'gender', $_POST['gender'] );
}
 
add_action( 'personal_options_update', 'save_profile_fields' );
add_action( 'edit_user_profile_update', 'save_profile_fields' );



	/*========================================================
	  *  SEO 
	========================================================*/
// add_filter( 'pre_get_document_title', function($title){
// 	global $post, $product;

// 	if(is_product() && is_single()){
// 	$text = '';
// 	$term_parent = get_the_terms($post->ID, 'product_cat' )[0];
// 	$text = $term_parent->name . ' ';
// 	$text .= $post->post_title;
// 	$text .= ' купить в Санкт-Петербурге - ';
// 	$text .= get_bloginfo('name');;
// 	return $text;
// 	}

// 	return $title;
// }	, 99 );


// add_filter( 'wpseo_metadesc', 'diviecim_wpseo_metadesc_filter' , 99);
// //фильтр описания страницы
// function diviecim_wpseo_metadesc_filter($html='')
// {

// 	global $post;
// 	$terms_all = get_the_terms($post->ID, 'product_cat' );
// 	$term_parent = $terms_all[0]->name;
// 	$term = $terms_all[1]->name;

// 	if(is_product()){
// 		$text = "Купить ";
// 		$text .= $post->post_title;
// 		$text .= " по выгодной цене и на лучших условиях. ";
// 		$text .= $term_parent;
// 		$text .= " от производителя ";
// 		$text .= $term;
// 		$text .= " в Санкт-Петербурге.";

// 		return $text;
// 	}

// 	return $html;
// }



