<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/*========================================================
		*		MINI CART
		========================================================*/
if ( ! function_exists( 'magic_header_cart' ) ) {
	function magic_header_cart() {
		if ( magic_is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
		?>
		<ul id="site-header-cart" class="site-header-cart menu">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php magic_cart_link(); ?>
			</li>
			<li>
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</li>
		</ul>
		<?php
		}
	}
}
if ( ! function_exists( 'magic_cart_link' ) ) {
	function magic_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'magic' ); ?>">
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span><span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'magic' ), WC()->cart->get_cart_contents_count() ) );?></span>
			</a>
		<?php
	}
}


/*========================================================
		*		CONTENT
		========================================================*/
if ( ! function_exists( 'magic_slider_wrapper' ) ) {

	function magic_slider_wrapper() {
		global $product;?>
				<div  class="carousel slide" data-ride="carousel">
				  <div class="carousel-inner" role="listbox">
				    <div class="carousel-item active">
		<?php
	}
}

if ( ! function_exists( 'magic_end_slider_wrapper' ) ) {
	function magic_end_slider_wrapper() {
 	  ?> 
			</a></div></div>
				  <a class="carousel-control-prev"  role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				  </a>
				  <a class="carousel-control-next"  role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				  </a>
				</div>
 	  <?php
	}
}

if ( ! function_exists( 'magic_template_loop_product_title' ) ) {
	function magic_template_loop_product_title() {

		echo '<h3 class="woocommerce-loop-product__title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
	}
}
if ( ! function_exists( 'action_woocommerce_new_order' ) ) {
	function action_woocommerce_new_order( $id ) { 

		update_post_meta($id, 'newKey', '');
	};
}if ( ! function_exists( 'magic_template_loop_product_title' ) ) {
	function magic_template_loop_product_title() {

		echo '<h3 class="woocommerce-loop-product__title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
	}
}
/*========================================================
		*		CARD
		========================================================*/
if ( ! function_exists( 'magic_woocommerce_sale_flash' ) ) {
	function magic_woocommerce_sale_flash($content) {
		global $product;
		if($var = get_post_meta($product->get_id(), '_new_opt')){
			$content  =  get_post_meta($product->get_id(), '_new_opt')[0];
		}else{
			$reg = (int)$product->get_regular_price();
			$price = (int)$product->get_sale_price();
			if($reg && $price && $reg !== 0){
				$var =	(int)(( $reg - $price ) / $reg * 100 );
				$content = $var? '-' . $var . ' %' : ''; 
			}
		}
		 $content = '<span class="onsale">' . $content . '</span>';
		return $content;
	}
}
if ( ! function_exists( 'magic_template_wrapper_price' ) ) {
	function magic_template_wrapper_price() {
		echo '<div class="shop_button">';
	}
}
if ( ! function_exists( 'magic_template_wrapper_price_end' ) ) {
	function magic_template_wrapper_price_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'woo_custom_single_add_to_cart_text' ) ){
	function woo_custom_single_add_to_cart_text() {
    return __( 'В корзину', 'magic' );
	}
}




/*========================================================
		*		шаблон для карусели
		========================================================*/
if ( ! function_exists( 'magic_woocommerce_template_carousel' ) ) {
	function magic_woocommerce_template_carousel( $id ) {
		global $product;
		 ?>
			<div class="carousel slide" data-ride="carousel">
				<div class="carousel-inner" role="listbox">
				  <div class="carousel-item active">
				  	<?php echo woocommerce_get_product_thumbnail(); ?>

						</a>
					</div>
				</div>
				<a class="carousel-control-prev"  role="button" data-slide="prev">
				  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				</a>
				<a class="carousel-control-next"  role="button" data-slide="next">
				  <span class="carousel-control-next-icon" aria-hidden="true"></span>
				</a>
			</div>
				    	<?php 
	};
}


/*========================================================
		*	AJAX
		========================================================*/
add_action( 'wp_enqueue_scripts', 'front_ajax_data', 99 );
function front_ajax_data(){
	wp_localize_script( 'front-end', 'frontAjax', 
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);  

}

/*========================================================
		*	slider
		========================================================*/
if( wp_doing_ajax() ){
add_action('wp_ajax_add_in_element', 'add_in_slider');
add_action('wp_ajax_nopriv_add_in_element', 'add_in_slider');
}

function add_in_slider() {
	$id_Produuct = intval( $_POST['idProduct'] );
	$product = wc_get_product($id_Produuct);
  $link = 	get_permalink( $product->get_id());
	if(	get_class($product) === 'WC_Product_Variable'){
	$args = array(
	  'post_type'     => 'product_variation',
	  'post_status'   => array( 'private', 'publish' ),
	  'numberposts'   => -1,
	  'orderby'       => 'menu_order',
	  'order'         => 'ASC',
	  'post_parent'   => $id_Produuct // get parent post-ID
	);
	$variations = get_posts( $args ); 
	foreach ( $variations as $variation ) {
	  $variation_ID = $variation->ID;
	  $product_variation = new WC_Product_Variation( $variation_ID );
	  $variation_image = $product_variation->get_image();
	  	$html  = '<div class="carousel-item"><a href="' . $link . '">';
			$html .= $variation_image;
	 		$html .= '</a></div>';
	 		echo $html;
		}
	}

	$attachment_ids = $product->get_gallery_image_ids();
	if ( $attachment_ids && has_post_thumbnail($id_Produuct) ) {
		foreach ( $attachment_ids as $attachment_id ) {
			$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
			$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
			$attributes      = array(
				'title'                   => get_post_field( 'post_title', $attachment_id ),
				'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
			);

			$html  = '<div class="carousel-item"><a href="' . $link . '">';
			$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
	 		$html .= '</a></div>';
	 		echo $html;
		}
	}
	wp_die();
}

/*========================================================
		*		Template 
		========================================================*/
if ( ! function_exists( 'magic_template_loop_variation_attributs' ) ) {

	function magic_template_loop_variation_attributs() {
		global $product;
		if(	get_class($product) === 'WC_Product_Variable'){
			$attributes = $product->get_variation_attributes();
			$attribute_keys = array_keys( $attributes );
			foreach ( $attributes as $attribute_name => $options ) : ?>

			 <div class="attribute-<?php echo wc_attribute_label( $attribute_name ); ?>" data-attribute-key="<?php echo $attribute_name; ?>">
					<?php  foreach ( $options as $attibute ) : ?>
					<span data-attribute="<?php echo $attibute; ?>"><?php echo $attibute; ?></span>
					<?php endforeach; ?>
			</div><?php endforeach; 
	}
}}

/*========================================================
		*	[Cart]	изменить цену товара
		========================================================*/
if ( ! function_exists( 'magic_add_custom_price' ) ) {
	function magic_add_custom_price( $cart_object ) {
		
      foreach ( $cart_object->get_cart_contents() as $key => $value ) {
      	$discount;
        if ($value['quantity']>1 && $value['quantity']<4) {
           $discount = $value['data']->get_price() * 0.02;  
        }
        elseif ($value['quantity']>3 && $value['quantity']<6) {
            $discount = $value['data']->get_price() * 0.05;  
        }
        elseif ($value['quantity']>5) {
            $discount = $value['data']->get_price() * 0.10;  
       } else { ''; return; }
      $value['data']->set_price( $value['data']->get_price() - $discount);

    }
}}

/*========================================================
		*		Убрать заказs из тпблицы
		========================================================*/
add_filter( 'edit_posts_per_page', 'edit_posts_per_pagefunction_to_add', 99,  2 );
function edit_posts_per_pagefunction_to_add($per_page = null,$post_type = null){
	global $wp_query, $pagenow;
	if($wp_query->query['post_type'] === 'shop_order' && $pagenow === 'edit.php'){
		$wp_query = new WP_Query(array_merge($wp_query->query, array('post__not_in' => array( 211,210 ))) );
	}
	return $per_page;
}

