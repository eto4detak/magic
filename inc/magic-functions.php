<?php 
/**
 * Magic  functions.
 *
 * @package Magic
 */

if ( ! function_exists( 'magic_is_woocommerce_activated' ) ) {
	/**
	 * Query WooCommerce activation
	 */
	function magic_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

function magic_body_classes( $classes ) {
	$classes[] = 'left-sidebar';
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
		// If our main sidebar doesn't contain widgets, adjust the layout to be full-width.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'magic-full-width-content';
	}

	return $classes;
}

/*========================================================
    *   Загружаем перевод
    ========================================================*/
add_action('after_setup_theme', 'magic_theme_setup');
function magic_theme_setup(){
  load_theme_textdomain('magic', get_template_directory() . '/languages');
}
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

