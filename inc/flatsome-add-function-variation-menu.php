<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'flatsome_update_selcet_variation_attribute', 10, 2 );
add_action('wp', 'flatsome_add_script_variation_product_attribute');

function flatsome_add_script_variation_product_attribute(){
	if( is_single() && is_product () )
		add_action( 'wp_enqueue_scripts', 'flatsome_scripts_add_method', 30 );
}

function flatsome_scripts_add_method() {
	$script_url =get_template_directory_uri() .'/assets/js/select-varitable-atrib.js';
	$style_url =get_template_directory_uri() .'/assets/css/style-variation-product-menu.css';
	wp_enqueue_script('varitable-atrib', $script_url, array('jquery'), '20180503', true );
	wp_enqueue_style( 'style-variation-menu', $style_url );
}

if ( ! function_exists( 'flatsome_get_menu_variation_attribute22' ) ) {
//сформировать меню
	function flatsome_get_menu_variation_attribute22($args='')
	{

			$args = wp_parse_args( apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ), array(
				'options'          => false,
				'attribute'        => false,
				'product'          => false,
				'selected' 	       => false,
				'name'             => '',
				'id'               => '',
				'class'            => '',
				'show_option_none' => __( 'Choose an option', 'woocommerce' ),
			) );

			$options               = $args['options'];
			$product               = $args['product'];
			$attribute             = $args['attribute'];
			$name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
			$id                    = $args['id'] ? $args['id'] : sanitize_title( $attribute );
			$class                 = $args['class'];
			$show_option_none      = $args['show_option_none'] ? true : false;
			$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' ); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

			if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
				$attributes = $product->get_variation_attributes();
				$options    = $attributes[ $attribute ];
			}

	//строим навигацию
			if ( ! empty( $options ) ) {
				if ( $product && taxonomy_exists( $attribute ) ) {

					$html = '<nav   class="animated bounceInDown"><ul class="animated-menu animated-menu-header">';//главный + обертка
						$general_sub_menu  = '<li class="sub-menu">';
							$general_sub_menu .= '<a >';
								$general_sub_menu .= '<div class="fa fa-icon-star-empty"></div>';
								$general_sub_menu .= '<span class="menu-select-value">' . esc_html( $show_option_none_text ) . '</span>' ;
								$general_sub_menu .= '<div class="fa fa-caret-down right"></div>';
							$general_sub_menu .= '</a>';
						$general_sub_menu .= '<ul style="display: none;" class="animated-menu">';
						$end_general_menu = '</ul></li>';
						
					$html .= $general_sub_menu; //добавить обертку 1 общий 

					$terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );
					$total = [];
					$count_arr = count($terms);

					for ($i=0; $i < $count_arr ; $i++) {
						if($terms[$i]){
							$str_general = explode(" ",$terms[$i]->name)[0];//первое слово из названия термина 
							 $obj =  new stdClass();
							 $obj->name = $terms[$i]->name;
							 $obj->slug = $terms[$i]->slug;
							 if(array_key_exists($str_general, $total)) continue;
						  $total[$str_general] = array($obj);
							if($str_general){
								for ($j=0; $j < $count_arr; $j++) { 
									$str_compare = explode(" ", $terms[$j]->name)[0];
									if(($str_general == $str_compare) && ($terms[$j] != $terms[$i]) ){
										$obj =  new stdClass();
										 $obj->name = $terms[$j]->name;
										 $obj->slug = $terms[$j]->slug;
										$total[$str_general][] = $obj;
									}
								}
							}
						}
					}

					$counter = 0;
					//$start_value = 0;//величина выше которой начинается группировка
					foreach ($total as $key =>  $arr_term) {

						$sub_menu  = '<li class="sub-menu">';
							$sub_menu .= '<a >';
								$sub_menu .= '<div class="fa fa-icon-star-empty"></div>';
								$sub_menu .= $key;
								$sub_menu .= '<div class="fa fa-caret-down right"></div>';
							$sub_menu .= '</a>';
						$sub_menu .= '<ul style="display: none;" class="animated-menu">';
						$end_sub_menu = '</ul></li>';

						//элемент  = выбор всех 
						if($counter === 0){
						$html .= '<li><a class="attr-select" rel="" data-attr="' . '" data-taxonomy="' . $attribute . '" ' . '><div class="fa fa-star-o"></div>' . esc_html( $show_option_none_text ) . '</a></li>';
						$counter++;
						}
						// var_dump($arr_term);
						// var_dump('<br>');
						//if(count($arr_term) > $startValue) $html .= $sub_menu;
						$counter_term = 0;
						foreach ( $arr_term as $term ) {
							if ( in_array( $term->slug, $options ) ) {
                if($counter_term === 0 ) 	 $html .= $sub_menu;
                $counter_term++;
								$html .= '<li><a class="attr-select" rel="" data-attr="' . esc_attr( $term->slug ) . '" data-taxonomy="' . $attribute . '" ' . '><div class="fa fa-star-o"></div>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) ) . '</a></li>';
							}
						}
						if($counter_term > 0) $html .= $end_sub_menu;
					}
				} else {
					foreach ( $terms as $term ) {
						if ( in_array( $term->slug, $options ) ) {
							$html .= '<li><a rel="nofollow" data-attr="' . esc_attr( $term->slug ) . '" data-taxonomy="' . $attribute . '" ' . '><div class="fa fa-star-o"></div>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) ) . '</a></li>';
						}
					}
				}
			}
			$html .= '</ul></nav>';//закрыть тэги главный + обертку

		return $html;
	}
}
if ( ! function_exists( 'flatsome_update_selcet_variation_attribute' ) ) {
function flatsome_update_selcet_variation_attribute($html, $args ){
 $html = substr_replace($html, ' style="display:none" ', strpos($html, 'select') + 6, 0);
   $menu = flatsome_get_menu_variation_attribute22($args);
	return $html . $menu;
}
}