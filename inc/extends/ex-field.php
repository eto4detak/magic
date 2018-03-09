<?php 
/*========================================================
  * [Работа с медиафайлами]  Дополнительные размеры медиафайлов 
========================================================*/
add_image_size('resource-single', 400, 300, true); 
add_image_size('resource-home', 300, 200, true); 
add_image_size('post-home', 300, 107, true); 

function res_new_image_sizes($sizes) {
    $mysizes = array(
        'resource-single' => 'Ресурс (большая)',
        'resource-home' => 'Ресурс (маленькая)',
        'post-home' => 'Пост (маленькая)',
    );
    $newsizes = array_merge($sizes, $mysizes);
    return $newsizes;
}
// Фильтрует имена и метки размеров изображений
add_filter('image_size_names_choose', 'res_new_image_sizes');
/*========================================================
  * [ / Работа с медиафайлами]
========================================================*/
/*========================================================
  * Создать поле опции в админке Настройки -> Общие
========================================================*/
function add_option_field_category_woocommerce(){
	$option_name = 'cat_slug_standart_template_woocommerce';
	register_setting( 'general', $option_name );
	add_settings_field( 
		'cat_slug_setting-id', 
		'Для стандартного вывода карточки по слагу категории (nameslug1, nameslug2)', 
		'sasasgsffasdasg_setting_callback_function', 
		'general', 
		'default', 
		array( 
			'id' => 'cat_slug_setting-id', 
			'option_name' => 'cat_slug_standart_template_woocommerce' 
		)
	);
}
add_action('admin_menu', 'add_option_field_category_woocommerce');
function sasasgsffasdasg_setting_callback_function( $data ){
	$id = $data['id'];
	$option_name = $data['option_name'];
	?>
	<textarea style="width:300px"
		type="text" 
		name="<? echo $option_name ?>" 
		id="<? echo $id ?>" 
		value="<? echo esc_attr( get_option($option_name) ) ?>"><? echo esc_attr( get_option($option_name) ) ?></textarea>
	<?
}

/*
Plugin Name: Произвольные записи 
Description: Произвольные записи "Ресурсы", таксономии "Коллекции" и "Метки". 
Version: 1.00
Author: Flector
Author URI: https://profiles.wordpress.org/flector#content-plugins
*/ 

/*========================================================
  *  Post Type: Ресурсы
========================================================*/
function register_resources_custom_posts() {

	$labels = array(
		"name" => __( "Ресурсы", "" ),
		"singular_name" => __( "Ресурс", "" ),
		"menu_name" => __( "Ресурсы", "" ),
		"all_items" => __( "Все ресурсы", "" ),
		"add_new" => __( "Добавить новый", "" ),
		"add_new_item" => __( "Добавить новый ресурс", "" ),
		"edit_item" => __( "Редактировать ресурс", "" ),
		"new_item" => __( "Новый ресурс", "" ),
		"view_item" => __( "Просмотреть ресурс", "" ),
		"view_items" => __( "Смотреть ресурсы", "" ),
		"search_items" => __( "Искать ресурс", "" ),
		"not_found" => __( "Ресурсов не найдено", "" ),
		"not_found_in_trash" => __( "В корзине ресурсов нет", "" ),
		"featured_image" => __( "Избранное изображение для ресурса", "" ),
		"set_featured_image" => __( "Установить избранное изображение для ресурса", "" ),
		"remove_featured_image" => __( "Удалить избранное изображение для ресурса", "" ),
		"use_featured_image" => __( "Использовать как избранное изображение для ресурса", "" ),
		"archives" => __( "Архив ресурсов", "" ),
		"insert_into_item" => __( "Вставить в ресурс", "" ),
		"uploaded_to_this_item" => __( "Загружено для этого ресурса", "" ),
	);

	$args = array(
		"label" => __( "Ресурсы", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
        'yarpp_support' => true,
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "resource", "with_front" => false ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "custom-fields", "comments", "revisions", "author" ),
	);
	register_post_type( "resource", $args );
}
add_action( 'init', 'register_resources_custom_posts' );


/*========================================================
  *  Taxonomy: Коллекции , метки
========================================================*/
function register_taxonomy_col_tag() {

	$labels = array(
		"name" => __( "Коллекции", "" ),
		"singular_name" => __( "Коллекция", "" ),
		"menu_name" => __( "Коллекции", "" ),
		"all_items" => __( "Все коллекции", "" ),
		"edit_item" => __( "Редактировать коллекцию", "" ),
		"view_item" => __( "Смотреть коллекцию", "" ),
		"update_item" => __( "Обновить имя коллекции", "" ),
		"add_new_item" => __( "Добавить новую коллекцию", "" ),
		"new_item_name" => __( "Имя новой коллекции", "" ),
		"parent_item" => __( "Родительская коллекция", "" ),
		"search_items" => __( "Искать коллекции", "" ),
		"popular_items" => __( "Популярные коллекции", "" ),
		"separate_items_with_commas" => __( "Разделите коллекции запятыми", "" ),
		"add_or_remove_items" => __( "Добавить или удалить коллекции", "" ),
		"choose_from_most_used" => __( "Выбрать из самых популярных коллекций", "" ),
		"not_found" => __( "Коллекций не найдено", "" ),
		"no_terms" => __( "Нет коллекций", "" ),
	);
	$args = array(
		"label" => __( "Коллекции", "" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Коллекции",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'collection', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "collection", array( "resource" ), $args );


	$labels = array(
		"name" => __( "Метки", "" ),
		"singular_name" => __( "Метка", "" ),
	);
	$args = array(
		"label" => __( "Метки", "" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => false,
		"label" => "Метки",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'rtag', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "rtag", array( "resource" ), $args );
}
add_action( 'init', 'register_taxonomy_col_tag' );


/*========================================================
    *    Добавить метабокс и поля в таксономию resourse
========================================================*/
function respost_meta_box(){
    add_meta_box('respost_meta_box', 'Информация о ресурсе', 'respost_callback', 'resource', 'normal' , 'high');
}
add_action( 'add_meta_boxes', 'respost_meta_box' );

//выводим метабокс 
function respost_callback(){
  global $post;
  wp_nonce_field( plugin_basename(__FILE__), 'respost_meta_nonce' );
    
  $res_main_page_meta = get_post_meta($post->ID, 'res_main_page_meta', true); 
  if (!$res_main_page_meta) {$res_main_page_meta = 'no';} 
  
  $in_top_meta = get_post_meta($post->ID, 'in_top_meta', true); 
  if (!$in_top_meta) {$in_top_meta = 'no';} 
  
  $ancor_url = get_post_meta($post->ID, 'ancor_url', true); 
  $res_url = get_post_meta($post->ID, 'res_url', true); 
  $fav_url = get_post_meta($post->ID, 'fav_url', true); 
  $relh2 = get_post_meta($post->ID, 'relh2', true);

  $res_date = get_post_meta($post->ID, 'res_date', true);
  $res_link = get_post_meta($post->ID, 'res_link', true);
  $res_link_t = get_post_meta($post->ID, 'res_link_t', true);
  $res_link2 = get_post_meta($post->ID, 'res_link2', true);
  $res_link2_t = get_post_meta($post->ID, 'res_link2_t', true);
  ?>   

  <p style="margin:5px!important;margin-top:10px!important;">
    
    URL ссылки: <br />
    <input type="text" name="res_url" size="60" value="<?php echo stripslashes($res_url); ?>" /><br />
    
     Анкор ссылки: <br />
    <input type="text" name="ancor_url" size="60" value="<?php echo stripslashes($ancor_url); ?>" /><br />
    
    URL favicon: <br />
    <input type="text" name="fav_url" size="60" value="<?php echo stripslashes($fav_url); ?>" /><br />
    
    Заголовок H2: <br />
    <input type="text" name="relh2" size="60" value="<?php echo stripslashes($relh2); ?>" /><br /><br />
    
    <label for="res_main_page_meta"><input type="checkbox" value="enabled" name="res_main_page_meta" id="res_main_page_meta" <?php if ($res_main_page_meta == 'yes') echo "checked='checked'"; ?> />Разместить на главной странице</label><br />
    
    <label for="in_top_meta"><input type="checkbox" value="enabled" name="in_top_meta" id="in_top_meta" <?php if ($in_top_meta == 'yes') echo "checked='checked'"; ?> />Разместить вверху коллекции</label>
 <br /> <br />
        Дата: <br />
    <input type="text" name="res_date" size="60" value="<?php echo stripslashes($res_date); ?>" /><br />
        URL ссылки 1: <br />
    <input type="text" name="res_link" size="60" value="<?php echo stripslashes($res_link); ?>" /><br />
        Текст ссылки 1: <br />
    <input type="text" name="res_link_t" size="60" value="<?php echo stripslashes($res_link_t); ?>" /><br /> <br />
        URL ссылки 2: <br />
    <input type="text" name="res_link2" size="60" value="<?php echo stripslashes($res_link2); ?>" /><br />
        Текст ссылки 2: <br />
    <input type="text" name="res_link2_t" size="60" value="<?php echo stripslashes($res_link2_t); ?>" /><br />
    
    </p>
<?php }

//сохраняем метабокс
function respost_save_metabox($post_id){
  global $post;
  if ( ! isset( $_POST['respost_meta_nonce'] ) ) return $post_id;
  if ( ! wp_verify_nonce($_POST['respost_meta_nonce'], plugin_basename(__FILE__) ) )return $post_id;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

  if(isset($_POST["res_main_page_meta"])){
      update_post_meta($post->ID, 'res_main_page_meta', 'yes');
  } else {
      update_post_meta($post->ID, 'res_main_page_meta', 'no');
  }   
  if(isset($_POST["in_top_meta"])){
      update_post_meta($post->ID, 'in_top_meta', 'yes');
  } else {
      update_post_meta($post->ID, 'in_top_meta', 'no');
  } 
    
  update_post_meta($post->ID, 'res_url', sanitize_text_field($_POST['res_url']));
  update_post_meta($post->ID, 'ancor_url', sanitize_text_field($_POST['ancor_url']));
  update_post_meta($post->ID, 'fav_url', sanitize_text_field($_POST['fav_url']));
  update_post_meta($post->ID, 'relh2', sanitize_text_field($_POST['relh2']));

  update_post_meta($post->ID, 'res_date', sanitize_text_field($_POST['res_date']));
  update_post_meta($post->ID, 'res_link', sanitize_text_field($_POST['res_link']));
  update_post_meta($post->ID, 'res_link_t', sanitize_text_field($_POST['res_link_t']));
  update_post_meta($post->ID, 'res_link2', sanitize_text_field($_POST['res_link2']));
  update_post_meta($post->ID, 'res_link2_t', sanitize_text_field($_POST['res_link2_t']));

  $rat = get_post_meta($post->ID, 'ec_stars_rating_ava', true); 
  if (!$rat) {
  update_post_meta($post->ID, 'ec_stars_rating_ava', '1');
  }
}
add_action('save_post', 'respost_save_metabox');

    //    доп поля для таксономии на странице добавления терминов
function my_taxonomy_add_meta_fields( $taxonomy ) {
    ?>

    <?php
}
add_action( 'collection_add_form_fields', 'my_taxonomy_add_meta_fields', 10, 2 );

// доп поля для таксономии на странице редактирования термина
function my_taxonomy_edit_meta_fields( $term, $taxonomy ) {
    $collection_thumb = get_term_meta( $term->term_id, 'collection_thumb', true );
    $collection_thumb_title = get_term_meta( $term->term_id, 'collection_thumb_title', true );
    $collection_thumb_alt = get_term_meta( $term->term_id, 'collection_thumb_alt', true );
    $collection_views = get_term_meta( $term->term_id, 'collection_views', true );
    $down_opis = get_term_meta( $term->term_id, 'down_opis', true );
    $collection_main = get_term_meta($term->term_id, 'collection_main', true); 

    $collection_q = get_term_meta( $term->term_id, 'collection_q', true );
    $collection_w = get_term_meta( $term->term_id, 'collection_w', true );
    $collection_e = get_term_meta( $term->term_id, 'collection_e', true );
    $collection_r = get_term_meta( $term->term_id, 'collection_r', true );
    $collection_t = get_term_meta( $term->term_id, 'collection_t', true );
    $collection_q_2 = get_term_meta( $term->term_id, 'collection_q_2', true );
    $collection_w_2 = get_term_meta( $term->term_id, 'collection_w_2', true );
    $collection_e_2 = get_term_meta( $term->term_id, 'collection_e_2', true );
    $collection_r_2 = get_term_meta( $term->term_id, 'collection_r_2', true );
    $collection_t_2 = get_term_meta( $term->term_id, 'collection_t_2', true );

    if (!$collection_main) {$collection_main = 'no';} 
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="collection_thumb"><?php _e( 'URL картинки коллекции:', 'my-plugin' ); ?></label>
        </th>
        <td>
            <input type="text" id="collection_thumb" name="collection_thumb" value="<?php echo $collection_thumb; ?>" />
        </td>
    </tr>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="collection_thumb_title"><?php _e( 'Title картинки коллекции:', 'my-plugin' ); ?></label>
        </th>
        <td>
            <input type="text" id="collection_thumb_title" name="collection_thumb_title" value="<?php echo $collection_thumb_title; ?>" />
        </td>
    </tr>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="collection_thumb_alt"><?php _e( 'Alt картинки коллекции:', 'my-plugin' ); ?></label>
        </th>
        <td>
            <input type="text" id="collection_thumb_alt" name="collection_thumb_alt" value="<?php echo $collection_thumb_alt; ?>" />
        </td>
    </tr>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="down_opis"><?php _e( 'Верхнее описание:', 'my-plugin' ); ?></label>
        </th>
        <td>
            <textarea rows="5" cols="60" name="down_opis" id="down_opis"><?php echo $down_opis; ?></textarea>
        </td>
    </tr>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="collection_views"><?php _e( 'Просмотры:', 'my-plugin' ); ?></label>
        </th>
        <td>
            <input type="text" id="collection_views" name="collection_views" value="<?php echo $collection_views; ?>" />
        </td>
    </tr>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="collection_views"><?php _e( 'Главная:', 'my-plugin' ); ?></label>
        </th>
        <td>
           <label for="collection_main"><input type="checkbox" value="enabled" name="collection_main" id="collection_main" <?php if ($collection_main == 'yes') echo "checked='checked'"; ?> />Разместить на главной странице</label><br />
        </td>
    </tr>

    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="collection_q"><?php _e( 'URL картинки коллекции 1:', 'my-plugin' ); ?></label>
            <label for="collection_q_2"><?php _e( 'Title картинки коллекции 1:', 'my-plugin' ); ?></label>
        </th>
        <td>
            <input type="text" id="collection_q" name="collection_q" value="<?php echo $collection_q; ?>" />
            <input type="text" id="collection_q_2" name="collection_q_2" value="<?php echo $collection_q_2; ?>" />
        </td>
    </tr>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="collection_w"><?php _e( 'URL картинки коллекции 2:', 'my-plugin' ); ?></label>
            <label for="collection_w_2"><?php _e( 'Title картинки коллекции 2:', 'my-plugin' ); ?></label>
        </th>
        <td>
            <input type="text" id="collection_w" name="collection_w" value="<?php echo $collection_w; ?>" />
            <input type="text" id="collection_w_2" name="collection_w_2" value="<?php echo $collection_w_2; ?>" />
        </td>
    </tr>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="collection_e"><?php _e( 'URL картинки коллекции 3:', 'my-plugin' ); ?></label>
            <label for="collection_e_2"><?php _e( 'Title картинки коллекции 3:', 'my-plugin' ); ?></label>
        </th>
        <td>
            <input type="text" id="collection_e" name="collection_e" value="<?php echo $collection_e; ?>" />
            <input type="text" id="collection_e_2" name="collection_e_2" value="<?php echo $collection_e_2; ?>" />
        </td>
    </tr>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="collection_r"><?php _e( 'URL картинки коллекции 4:', 'my-plugin' ); ?></label>
            <label for="collection_r_2"><?php _e( 'Title картинки коллекции 4:', 'my-plugin' ); ?></label>
        </th>
        <td>
            <input type="text" id="collection_r" name="collection_r" value="<?php echo $collection_r; ?>" />
            <input type="text" id="collection_r_2" name="collection_r_2" value="<?php echo $collection_r_2; ?>" />
        </td>
    </tr>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="collection_t"><?php _e( 'URL картинки коллекции 5:', 'my-plugin' ); ?></label>
            <label for="collection_t_2"><?php _e( 'Title картинки коллекции 5:', 'my-plugin' ); ?></label>
        </th>
        <td>
            <input type="text" id="collection_t" name="collection_t" value="<?php echo $collection_t; ?>" />
            <input type="text" id="collection_t_2" name="collection_t_2" value="<?php echo $collection_t_2; ?>" />
        </td>
    </tr>
    <?php
}
add_action( 'collection_edit_form_fields', 'my_taxonomy_edit_meta_fields', 10, 2 );

// сохранить доп поля таксономии
function my_taxonomy_save_taxonomy_meta( $term_id, $tag_id ) {
    if( isset( $_POST['collection_thumb'] ) ) {
        update_term_meta( $term_id, 'collection_thumb', esc_attr( $_POST['collection_thumb'] ) );
    }
    if( isset( $_POST['collection_thumb_title'] ) ) {
        update_term_meta( $term_id, 'collection_thumb_title', esc_attr( $_POST['collection_thumb_title'] ) );
    }
    if( isset( $_POST['collection_thumb_alt'] ) ) {
        update_term_meta( $term_id, 'collection_thumb_alt', esc_attr( $_POST['collection_thumb_alt'] ) );
    }
    if( isset( $_POST['collection_views'] ) ) {
        update_term_meta( $term_id, 'collection_views', esc_attr( $_POST['collection_views'] ) );
    }
    if( isset( $_POST['down_opis'] ) ) {
        update_term_meta( $term_id, 'down_opis', esc_attr( $_POST['down_opis'] )) ;
    }
    if(isset($_POST["collection_main"])){
        update_term_meta($term_id, 'collection_main', 'yes');
    } else {
        update_term_meta($term_id, 'collection_main', 'no');
    } 

    if( isset( $_POST['collection_q'] ) ) {
        update_term_meta( $term_id, 'collection_q', esc_attr( $_POST['collection_q'] ) );
    }
    if( isset( $_POST['collection_w'] ) ) {
        update_term_meta( $term_id, 'collection_w', esc_attr( $_POST['collection_w'] ) );
    }
    if( isset( $_POST['collection_e'] ) ) {
        update_term_meta( $term_id, 'collection_e', esc_attr( $_POST['collection_e'] ) );
    }
    if( isset( $_POST['collection_r'] ) ) {
        update_term_meta( $term_id, 'collection_r', esc_attr( $_POST['collection_r'] ) );
    }
    if( isset( $_POST['collection_t'] ) ) {
        update_term_meta( $term_id, 'collection_t', esc_attr( $_POST['collection_t'] ) );
    }
        if( isset( $_POST['collection_q_2'] ) ) {
        update_term_meta( $term_id, 'collection_q_2', esc_attr( $_POST['collection_q_2'] ) );
    }
    if( isset( $_POST['collection_w_2'] ) ) {
        update_term_meta( $term_id, 'collection_w_2', esc_attr( $_POST['collection_w_2'] ) );
    }
    if( isset( $_POST['collection_e_2'] ) ) {
        update_term_meta( $term_id, 'collection_e_2', esc_attr( $_POST['collection_e_2'] ) );
    }
    if( isset( $_POST['collection_r_2'] ) ) {
        update_term_meta( $term_id, 'collection_r_2', esc_attr( $_POST['collection_r_2'] ) );
    }
    if( isset( $_POST['collection_t_2'] ) ) {
        update_term_meta( $term_id, 'collection_t_2', esc_attr( $_POST['collection_t_2'] ) );
    }
}
add_action( 'created_collection', 'my_taxonomy_save_taxonomy_meta', 10, 2 );
add_action( 'edited_collection', 'my_taxonomy_save_taxonomy_meta', 10, 2 );

function my_taxonomy_add_field_columns( $columns ) {
    //$columns['collection_thumb'] = __( 'URL картинки коллекции:', 'my-plugin' );
    return $columns;
}
add_filter( 'manage_edit-composer_columns', 'my_taxonomy_add_field_columns' );