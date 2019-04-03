<?php 		/*========================================================
				*		Ajax
				========================================================*/
add_action( 'wp_enqueue_scripts', 'construct_myajax_data', 99 );
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
window.addEventListener('message', function(e){
	var data = {
	action: 'my_action',
	constructData: e.data
};
jQuery.post( myajax.url, data, function(response) {
	console.log('Добален товар');
});

	console.log(e);
	JSON.parse(e.data, function(k, v) {
 console.log(k + ' = ' + v); 
});
} );
</script> -->
	<?php
}

if( wp_doing_ajax() ){
	add_action('wp_ajax_c_add_product', 'construct_add_product');
	add_action('wp_ajax_nopriv_c_add_product', 'construct_add_product');
}
function construct_add_product() {
		if( ! wp_verify_nonce( $_POST['nonce_code'], 'myajax-nonce' ) ) die( 'Stop!');
/*========================================================
		*		Добавим товар
		========================================================*/
global $woocommerce;
$b = $_POST['constructData'];

$c = str_replace('\\', "", $b);
$a = mb_strcut($c, strripos($c, 'id')-1);
$a = '{' .$a;
$data_constr = json_decode($a);
$b_new =  wp_unslash($b);
$data_constr_sl = json_decode($b_new);

if(empty($data_constr->id)) wp_die();
$content 	=  	'Заказ id =  ' . $data_constr->id . "<br>";
$content 	.=  'base = ' . $data_constr->vars->base . "   ||   ";
$content 	.=  'model = ' . $data_constr->vars->model . "   ||   ";
$content 	.=  'color = ' . $data_constr->vars->color . "   ||   ";
$content 	.=  'sex = ' . $data_constr->vars->sex . "   ||   ";
$content 	.=  'age = ' . $data_constr->vars->age . "<br>";
$content 	.=  'size = ' . $data_constr->vars->size . "   ||   ";
$content 	.=  'userlang = ' . $data_constr->vars->userlang . "   ||   ";
$content 	.=  'adminlang = ' . $data_constr->vars->adminlang . "   ||   ";
$content 	.=  'method = ' . $data_constr->vars->method . "<br>";
$content 	.=  'Информация о заказе :  ';
foreach ($data_constr->vars->readableUserLang as $key => $value) {
	$content 	.=  $value . "   ||   ";} $content 	.=  "<br>";
foreach ($data_constr->fields as $value) {
	foreach ($value as $key => $v) {
		if($key === 'type') continue;
		$content 	.=  $v . "  ||  ";
	}
	$content 	.=  "<br>";
}

$post = array(
    'post_author' => get_current_user_id(),
    'post_content' => $content,
    'post_status' => "draft",
    'post_title' => $data_constr->vars->readableUserLang->base.' ' . time(),
    'post_parent' => '',
    'post_type' => "product",
);

$post_id = wp_insert_post( $post );
if($post_id){
	// wp_set_object_terms( $post_id, 'NameCategory', 'product_cat' );
	// wp_set_object_terms($post_id, 'simple', 'product_type');
	update_post_meta( $post_id, '_visibility', 'visible' );
	$product =		wc_get_product($post_id);
	$product->set_catalog_visibility( 'hidden' );
	$product->save();
	update_post_meta( $post_id, '_stock_status', 'instock');
	// update_post_meta( $post_id, 'total_sales', $data_constr_sl? absint($data_constr_sl->sum) : 0 );
	update_post_meta( $post_id, '_downloadable', 'no');
	update_post_meta( $post_id, '_virtual', 'no');
	update_post_meta( $post_id, '_regular_price', $data_constr_sl? absint($data_constr_sl->sum) : 0 );
	// update_post_meta( $post_id, '_sale_price', $data_constr_sl? absint($data_constr_sl->sum) : 0 );
	update_post_meta( $post_id, '_purchase_note', "" );
	update_post_meta( $post_id, '_featured', "no" );
	update_post_meta( $post_id, '_weight', "" );
	update_post_meta( $post_id, '_length', "" );
	update_post_meta( $post_id, '_width', "" );
	update_post_meta( $post_id, '_height', "" );
	update_post_meta(	$post_id, '_sku', "");
	update_post_meta( $post_id, '_product_attributes', array());
	update_post_meta( $post_id, '_sale_price_dates_from', "" );
	update_post_meta( $post_id, '_sale_price_dates_to', "" );
	update_post_meta( $post_id, '_price',  $data_constr_sl? absint($data_constr_sl->sum) : 0 );
	update_post_meta( $post_id, '_sold_individually', "" );
	update_post_meta( $post_id, '_manage_stock', "no" );
	update_post_meta( $post_id, '_backorders', "no" );
	update_post_meta( $post_id, '_stock', "" );

	update_post_meta( $post_id, '_data_constructor', $b);
	update_post_meta( $post_id, '_is_constructor_product', true);


	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );
	$file_array = [];
	$tmp = download_url($data_constr->thumb);
	preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $data_constr->thumb, $matches );
	$file_array['name'] = basename($matches[0]);
	$file_array['tmp_name'] = $tmp;
	$media_id = media_handle_sideload( $file_array, $post_id);
	if( is_wp_error($media_id) ) {
		@unlink($file_array['tmp_name']);
		echo $media_id->get_error_messages();
	}
	@unlink( $file_array['tmp_name'] );
	set_post_thumbnail($post_id, $media_id);
	/*// file paths will be stored in an array keyed off md5(file path)
$downdloadArray =array('name'=>"Test", 'file' => $uploadDIR['baseurl']."/video/".$video);

$file_path =md5($uploadDIR['baseurl']."/video/".$video);


$_file_paths[  $file_path  ] = $downdloadArray;
// grant permission to any newly added files on any existing orders for this product
// do_action( 'woocommerce_process_product_file_download_paths', $post_id, 0, $downdloadArray );
update_post_meta( $post_id, '_downloadable_files', $_file_paths);
update_post_meta( $post_id, '_download_limit', '');
update_post_meta( $post_id, '_download_expiry', '');
update_post_meta( $post_id, '_download_type', '');
update_post_meta( $post_id, '_product_image_gallery', '');*/
	$woocommerce->cart->add_to_cart( $post_id );
}
/*========================================================
		*		end товар добавлен
		========================================================*/
	wp_die();
}

/*========================================================
			*		end ajax
========================================================*/

/*========================================================
		*		Удалить продукт
		========================================================*/
add_action('woocommerce_order_status_completed', 'construct_delete_products');
function construct_delete_products( $order_id ) {
	$order = new WC_Order( $order_id );
	$items = $order->get_items();
	if (is_array($items)) {
		foreach ($items as $item) {
			if(	get_post_meta( $item['product_id'], '_is_constructor_product',true ))
			wp_trash_post( $item['product_id'] );
		}
	}
}
/*========================================================
		*		end удален продукт
		========================================================*/
?>
/*========================================================
		*		end удален продукт
		========================================================*/
?>
		<iframe src="https://cosuv.ru/app/2556" style="width:100%;height:600px;position:relative;" frameborder="0" allowfullscreen></iframe>
		<script type="text/javascript">
		window.addEventListener('message', function(e){
		var data = {
			action: 'c_add_product',
			constructData: e.data,
			nonce_code : myajax.nonce
		};
		jQuery.post( myajax.url, data, function(response) {
			jQuery( document.body ).trigger( 'updated_wc_div' );
		});
		});
		</script>