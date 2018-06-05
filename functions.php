<?php
/**
 * magic functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package magic
 */

$magic = (object) array(
	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-magic.php',
	'customizer' => require 'inc/customizer/class-magic-customizer.php',
);
require get_template_directory() . '/inc/magic-functions.php';
require get_template_directory() . '/inc/magic-template-hooks.php';
require get_template_directory() . '/inc/magic-template-functions.php';
require get_template_directory() . '/inc/magic-extends.php';

if ( magic_is_woocommerce_activated() ) {
	$magic->woocommerce = require 'inc/woocommerce/class-magic-woocommerce.php';
	require_once 'inc/woocommerce/magic-woocommerce-template-hooks.php';
	require_once 'inc/woocommerce/magic-woocommerce-template-functions.php';
	require_once 'inc/woocommerce/magic-woocommerce-function.php';
}

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
	  *  
	========================================================*/

add_action('admin_menu', 'access_register_wc_submenu_page');

function access_register_wc_submenu_page() {
  add_submenu_page( 'edit.php?post_type=product', 'Страна для подкатегории', 'Страна для подкатегории', 'manage_options', 'access-product-attribute-state', 'access_my_wc_submenu_page_callback' ); 
}

function access_my_wc_submenu_page_callback() {
  // контент страницы
	$args = array(
	'taxonomy' => 'product_cat',
	);
	$terms = get_terms( $args );

  echo '<div class="wrap"><h3 class="edit-attributes__description">Изменить страну производителя для подкатегории</h3>';
	if( $terms && ! is_wp_error($terms) ){
		echo "<div class='edit-attributes__main'>";
		foreach( $terms as $term ){
			if($term->parent === 0){
				echo "<div class='taxonomy-name'><span data-slug='{$term->slug}' class='edit-attributes__header'>Категория: ". $term->name ."</span>";
				foreach ($terms as $t_ch) {
					if($term->term_id === $t_ch->parent ){
							echo "<div class='term-name'><div style='width:200px;display:inline-block'>-{$t_ch->name}</div><input class='input' value='" . get_term_meta( $t_ch->term_id, 'text_for_state_atr', true ) . "' data-id='{$t_ch->term_id}' data-term='{$t_ch->slug}' type='text' data-cat='{$term->slug}'><button class='term-update'>Обновить</button></div>";
					}
				}
				echo "</div>";//term-name taxonomy-name
		  }
	  }
	  echo "</div>";//edit-attributes__main
  }

  echo '</div>';
  ?>
  <script type='text/javascript'>
(function($) {
	jQuery('.term-update').on("click", function(e) {
		var $input = jQuery(this).siblings('input');
		var cat =	$input.data('cat');
		var term =	$input.data('term');
		var id =	$input.data('id');
		var value = $input.val();
			var dataTerm = {};
			dataTerm.cat = cat;
			dataTerm.term = term;
			dataTerm.vid = id;
			dataTerm.val = value;
     var str = JSON.stringify(dataTerm);
				var data = {
		action: 'c_add_product',
		dataType: 'json',
		consData: str,
		nonce_code : myajax.nonce
	};
	jQuery.post( myajax.url, data, function(response) {
		if(response == 1) alert('Обновлены продукты');
			else alert('Продукты не обновлены, неверные данные');
		
	});
		});
})(jQuery);
</script>

<?php  
}

if( wp_doing_ajax() ){
	add_action('wp_ajax_c_add_product', 'construct_add_product');
	add_action('wp_ajax_nopriv_c_add_product', 'construct_add_product');
}
function construct_add_product() {
	global $post;
		if( ! wp_verify_nonce( $_POST['nonce_code'], 'myajax-nonce' ) ) die( 'Stop!');
$json = $_POST['consData'];
	$json = str_replace('\\', "", $json);
	$obj = json_decode($json);

	if(!empty($obj) && $obj->term && $obj->cat && $obj->val && $obj->vid )
	{
		access_find_cat_attribute_woocommerce($obj);
  	update_term_meta( $obj->vid, 'text_for_state_atr', $obj->val );
  	echo 1;
	}
	else{
		echo 0;
	}

  
	wp_die();
}

// найти атрибуты подкатегорий(1го уровня) woocommerce
function access_find_cat_attribute_woocommerce($obj='')
{
	$args = array(
	'taxonomy' => 'product_cat',
	);
	$terms = get_terms( $args );

	if( $terms && ! is_wp_error($terms) ){
		foreach( $terms as $term ){
			if($term->parent === 0 && $term->slug === $obj->cat){
				foreach ($terms as $t_ch) {
					if($term->term_id === $t_ch->parent && $t_ch->slug === $obj->term ){
           access_set_attribute_woocommerce($t_ch,$obj->val);
					}
				}
			}
		}
	}
}
//обновить атрибут продукта woocommerce
 function access_set_attribute_woocommerce($cat='', $value = '')
{
		global $post;
	//	$custom_attribute = 'pa_strana-proizvodstva';
		$custom_attribute = htmlspecialchars(stripslashes('pa_strana-proizvodstva'));
		$value_attr =  htmlspecialchars(stripslashes($value));
		$args = array(
	   'post_type' => 'product',
	   'product_cat' => $cat->slug,
	   'posts_per_page'=>-1
		);

	$my_query = new WP_Query( $args );

	if( $my_query->have_posts() ) {

	   while ($my_query->have_posts()) : $my_query->the_post(); 
			wp_delete_object_term_relationships( get_the_ID(),  $custom_attribute );
			$term_taxonomy_ids = wp_set_object_terms( get_the_ID(), $value_attr, $custom_attribute, true );
			$attributes = get_post_meta( $post->ID, '_product_attributes' );
			$attributes[0][ sanitize_title( $custom_attribute ) ] = array(
	      'name'          => wc_clean( $custom_attribute ),
	     'value'=>'',
	     'is_visible' => '1',
	     'is_variation' => '0',
	     'is_taxonomy' => '1'
			);
			update_post_meta(get_the_ID(), '_product_attributes', $attributes[0] );
	   endwhile;
	}
	wp_reset_query();
}

	/*========================================================
				*		Ajax
				========================================================*/

add_action( 'admin_enqueue_scripts', 'construct_myajax_data');
function construct_myajax_data(){
	wp_localize_script( 'jquery', 'myajax', 
		array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('myajax-nonce')
		)
	);
}

add_action('admin_print_footer_scripts', 'construct_action_javascript', 99);
function construct_action_javascript() {
	?>
<!-- 		<script type="text/javascript">
	jQuery(document).ready(function($) {
		var data = {
			action: 'my_action',
			whatever: 1234
		};

		// с версии 2.8 'ajaxurl' всегда определен в админке
		jQuery.post( ajaxurl, data, function(response) {
			alert('Получено с сервера: ' + response);
		});
	});
</script> -->
	<?php
}
function vardd($var) {
  echo '<pre class="aaa" style="display:none">';
  var_dump($var);
  echo '</pre>';
}


	/*========================================================
	  *  SEO 
	========================================================*/
add_filter( 'pre_get_document_title', function($title){
	global $post, $product;

	if(is_product() && is_single()){
	$text = '';
	$term_parent = get_the_terms($post->ID, 'product_cat' )[0];
	$text = $term_parent->name . ' ';
	$text .= $post->post_title;
	$text .= ' купить в Санкт-Петербурге - ';
	$text .= get_bloginfo('name');;
	return $text;
	}

	return $title;
}	, 99 );


add_filter( 'wpseo_metadesc', 'diviecim_wpseo_metadesc_filter' , 99);
//фильтр описания страницы
function diviecim_wpseo_metadesc_filter($html='')
{

	global $post;
	$terms_all = get_the_terms($post->ID, 'product_cat' );
	$term_parent = $terms_all[0]->name;
	$term = $terms_all[1]->name;

	if(is_product()){
		$text = "Купить ";
		$text .= $post->post_title;
		$text .= " по выгодной цене и на лучших условиях. ";
		$text .= $term_parent;
		$text .= " от производителя ";
		$text .= $term;
		$text .= " в Санкт-Петербурге.";

		return $text;
	}

	return $html;
}
