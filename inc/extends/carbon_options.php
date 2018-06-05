<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

if ( ! function_exists( 'carbon_get_post_meta' ) ) {
	function carbon_get_post_meta( $id, $name, $type = null ) {
		return false;
	}   
}

if ( ! function_exists( 'carbon_get_the_post_meta' ) ) {
	function carbon_get_the_post_meta( $name, $type = null ) {
		return false;
	}   
}

if ( ! function_exists( 'carbon_get_theme_option' ) ) {
	function carbon_get_theme_option( $name, $type = null ) {
		return false;
	}   
}

if ( ! function_exists( 'carbon_get_term_meta' ) ) {
	function carbon_get_term_meta( $id, $name, $type = null ) {
		return false;
	}   
}

if ( ! function_exists( 'carbon_get_user_meta' ) ) {
	function carbon_get_user_meta( $id, $name, $type = null ) {
		return false;
	}   
}

if ( ! function_exists( 'carbon_get_comment_meta' ) ) {
	function carbon_get_comment_meta( $id, $name, $type = null ) {
		return false;
	}   
}

if(class_exists('Carbon_Fields\Container') )
{
	// Container::make( 'aaaaaaa', 'edit-tags.php?taxonomy=product_cat&post_type=product' )
	// 	 ->add_tab( 'Шапка сайта', array(
	// 		 Field::make( 'complex', 'crb_contact_address', 'Настройки кантактов' )->add_class('my-custom-class')
	// 			  ->add_fields( array(
	// 				  Field::make( 'text', 'email', '' )->set_width( 50 )
	// 			  ) ),
	// 			Field::make( 'complex', 'magic_currency', 'Добавьте валюту' )
	// 			  ->add_fields( array(
	// 				  Field::make( 'text', 'mini_сurrency', 'Краткая запись валюты' )->set_width( 30 ),
	// 				  Field::make( 'text', 'сurrency', 'Описание валюты' )->set_width( 70 )
	// 			  ) ),
	// 			Field::make( 'complex', 'magic_language', 'Добавьте язык' )
	// 			  ->add_fields( array(
	// 				  Field::make( 'text', 'language', 'Язык' )->set_width( 50 ),
	// 			  ) ),

	// 	 ) );
//edit-tags.php?taxonomy=product_cat&post_type=product
	Container::make( 'term_meta', 'Настройки Term' )
		 ->show_on_taxonomy( 'product_cat' ) // По умолчанию, можно не писать
		//->show_on_category('product_cat')
		 ->add_fields( array(
			 //Field::make( 'text', 'title_color', 'Цвет заголовка' ),
			 Field::make("checkbox", "crb_exclude_cat", "Скрыть категорию для незарегистрированных пользователей")
				  ->set_option_value('yes')
		 ) );

// Container::make( 'theme_options', 'Управление' )
// 		 ->add_tab( 'Шапка сайта', array(
// 			 Field::make( 'complex', 'crb_contact_address', 'Настройки кантактов' )->add_class('my-custom-class')
// 				  ->add_fields( array(
// 					  Field::make( 'text', 'email', '' )->set_width( 50 )
// 				  ) ),
// 				Field::make( 'complex', 'magic_currency', 'Добавьте валюту' )
// 				  ->add_fields( array(
// 					  Field::make( 'text', 'mini_сurrency', 'Краткая запись валюты' )->set_width( 30 ),
// 					  Field::make( 'text', 'сurrency', 'Описание валюты' )->set_width( 70 )
// 				  ) ),
// 				Field::make( 'complex', 'magic_language', 'Добавьте язык' )
// 				  ->add_fields( array(
// 					  Field::make( 'text', 'language', 'Язык' )->set_width( 50 ),
// 				  ) ),

// 		 ) )
// 		 ->add_tab( 'Наша команда', array(
// 			 Field::make( 'complex', 'crb_places', 'Список' )
// 				  ->add_fields( array(
// 					  Field::make( 'image', 'photo', 'Фото' )->set_value_type( 'url' )->set_width( 33 ),
// 					  Field::make( 'text', 'job', 'Должность' )->set_width( 33 ),
// 					  Field::make( 'text', 'fio', 'Фамилия, имя и отчество' )->set_width( 33 )
// 				  ) )
// 		 ) )
// 		 ->add_tab( 'Контакты', array(
// 			 Field::make( 'text', 'url_fb', 'Фейсбук' ),
// 			 Field::make( 'text', 'url_vk', 'вКонтакте' ),
// 			 Field::make( 'text', 'url_tw', 'Твиттер' ),
// 			 Field::make( 'text', 'url_sk', 'Скайп' ),
// 			 Field::make( 'text', 'url_lin', 'ЛинкедИн' ),
// 			 Field::make( "map", "crb_company_location", "Местоположение" )
// 				  ->help_text( 'Перетащите указатель на карту, чтобы выбрать местоположение' ),
// 		 ) )
// 		 ->add_tab( 'СЕО', array(
// 			 Field::make( 'text', 'title-lp', 'Title лендинга' ),
// 			 Field::make( 'text', 'description-lp', 'Description лендинга' ),
// 			 Field::make( "header_scripts", "header_google_analytics", 'Код счётчика Гугл.Аналитикс' ),
// 			 Field::make( "header_scripts", "header_script_yandex_metrika", 'Код счётчика Яндекс.Метрики' ),
// 		 ) )
//  		->add_tab( 'Слайдер', array(
//  				 Field::make( 'complex', 'magic_slider', 'Добавить слайдер' )
// 				  ->add_fields( array(
// 					  Field::make( 'text', 'magic_slider_name', 'Уникальное имя слайдера' )->set_width( 33 ),
// 						Field::make( 'text', 'magic_slider_Description', 'Описание слайдера' )->set_width( 33 ),
// 						Field::make( 'complex', 'magic_info', 'Добавить слайдер' )->set_layout( 'tabbed-vertical' )
// 						  ->add_fields( array(
// 							  Field::make("image", "photo", "Фото")->set_width( 33 )->add_class('my-custom-class')->set_value_type( 'url' ),
// 							  Field::make( 'text', 'text1', 'Текст 1' )->set_width( 33 ),
// 							  Field::make( 'text', 'text2', 'Текст 2' )->set_width( 33 ),
// 							  Field::make( 'text', 'text3', 'Текст 3' )->set_width( 33 ),
// 							  Field::make( 'text', 'button', 'Текст кнопки' )->set_width( 33 ),
// 						  ) ),
// 				  ) ),

// 		 ) )
// 		 ;
// Container::make( 'term_meta', 'Настройки Term' )
// 		 ->show_on_taxonomy( 'pa_color' ) // По умолчанию, можно не писать
// 		 ->add_fields( array(
// 			 Field::make( 'color', 'title_color', 'Цвет заголовка' ),
// 			 Field::make( 'image', 'thumb', 'Миниатюра' ),
// 		 ) );
}