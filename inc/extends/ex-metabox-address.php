<?php

new My_Best_Metaboxes;

class My_Best_Metaboxes {

	public $post_type = 'post';

	static $meta_key = 'company_address';

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
		add_action( 'save_post_' . $this->post_type, array( $this, 'save_metabox' ) );
		add_action( 'admin_print_footer_scripts', array( $this, 'show_assets' ), 10, 999 );
	}

	## Добавляет матабоксы
	public function add_metabox() {
		add_meta_box( 'box_info_company', 'Информация о компании', array( $this, 'render_metabox' ), $this->post_type, 'advanced', 'high' );
	}

	## Отображает метабокс на странице редактирования поста
	public function render_metabox( $post ) {
		?>
		<table class="form-table company-info">

			<tr>
				<th>
					Адреса компании <span class="dashicons dashicons-plus-alt add-company-address"></span>
				</th>
				<td class="company-address-list">
					<?php
					$input = '
					<span class="item-address">
						<input type="text" name="'. self::$meta_key .'[]" value="%s">
						<span class="dashicons dashicons-trash remove-company-address"></span>
					</span>
					';

					$addresses = get_post_meta( $post->ID, self::$meta_key, true );

					if ( is_array( $addresses ) ) {
						foreach ( $addresses as $addr ) {
							printf( $input, esc_attr( $addr ) );
						}
					} else {
						printf( $input, '' );
					}
					?>
				</td>
			</tr>

		</table>

		<?php
	}

	## Очищает и сохраняет значения полей
	public function save_metabox( $post_id ) {

		// Check if it's not an autosave.
		if ( wp_is_post_autosave( $post_id ) )
			return;

		if ( isset( $_POST[self::$meta_key] ) && is_array( $_POST[self::$meta_key] ) ) {
			$addresses = $_POST[self::$meta_key];

			$addresses = array_map( 'sanitize_text_field', $addresses ); // очистка

			$addresses = array_filter( $addresses ); // уберем пустые адреса

			if ( $addresses ) {
				update_post_meta( $post_id, self::$meta_key, $addresses );
			}
			else {
				delete_post_meta( $post_id, self::$meta_key );
			}
		}
	}

	## Подключает скрипты и стили
	public function show_assets() {
		if ( is_admin() && get_current_screen()->id == $this->post_type ) {
			$this->show_styles();
			$this->show_scripts();
		}
	}

	## Выводит на экран стили
	public function show_styles() {
		?>
		<style>
			.add-company-address {
				color: #00a0d2;
				cursor: pointer;
			}
			.company-address-list .item-address {
				display: flex;
				align-items: center;
			}
			.company-address-list .item-address input {
				width: 100%;
				max-width: 400px;
			}
			.remove-company-address {
				color: brown;
				cursor: pointer;
			}
		</style>
		<?php
	}

	## Выводит на экран JS
	public function show_scripts() {
		?>
		<script>
			jQuery(document).ready(function ($) {

				var $companyInfo = $('.company-info');

				// Добавляет бокс с вводом адреса фирмы
				$('.add-company-address', $companyInfo).click(function () {
					var $list = $('.company-address-list');
						$item = $list.find('.item-address').first().clone();

					$item.find('input').val(''); // чистим знанчение

					$list.append( $item );
				});

				// Удаляет бокс с вводом адреса фирмы
				$companyInfo.on('click', '.remove-company-address', function () {
					if ($('.item-address').length > 1) {
						$(this).closest('.item-address').remove();
					}
					else {
						$(this).closest('.item-address').find('input').val('');
					}
				});

			});
		</script>
		<?php
	}

}


/*============================================
	metabox
===============================================*/
	// Добавляем блоки в основную колонку на страницах постов и пост. страниц
add_action('add_meta_boxes', 'child_travelify_add_custom_box');
function child_travelify_add_custom_box(){
	$screens = array( 'post', 'page' );
	add_meta_box( 'child_travelify_sectionid', 'Дополнительный блок', 'child_travelify_meta_box_callback', $screens );
}

// HTML код блока
function child_travelify_meta_box_callback( $post, $meta ){
	$screens = $meta['args'];

	// Используем nonce для верификации
	wp_nonce_field( plugin_basename(__FILE__), 'child_travelify_noncename' );

     if(!empty(get_post_meta( $post->ID, '_my_meta_value_key'))) $flag_no_title = get_post_meta( $post->ID, '_my_meta_value_key');
	// Поля формы для введения данных
	echo '<label for="child_travelify_new_field">' . __("Скрыть заголовок страницы", 'child_travelify_textdomain' ) . '</label> ';
	echo '<input type="text" id= "child_travelify_new_field" name="child_travelify_new_field" value="'. $flag_no_title[0] .'" size="25" />';
	?>
		<p>
		<input type="hidden" name="extra[white]" value="">
		<label><input type="checkbox" name="extra[white]" value="1" <?php checked( get_post_meta($post->ID, 'white', 1), 1 )?> /> белый</label>
		<input type="hidden" name="extra[red]" value="">
		<label><input type="checkbox" name="extra[red]" value="1"   <?php checked( get_post_meta($post->ID, 'red',   1), 1 )?> /> красный</label>
		<input type="hidden" name="extra[black]" value="">
		<label><input type="checkbox" name="extra[black]" value="1" <?php checked( get_post_meta($post->ID, 'black', 1), 1 )?> /> черный</label>
	</p>
	<?php 
}

// Сохраняем данные, когда пост сохраняется
add_action( 'save_post', 'child_travelify_save_postdata' );
function child_travelify_save_postdata( $post_id ) {
	
	// проверяем nonce нашей страницы, потому что save_post может быть вызван с другого места.
	if ( ! wp_verify_nonce( $_POST['child_travelify_noncename'], plugin_basename(__FILE__) ) )
		return;

	// если это автосохранение ничего не делаем
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return;

	// проверяем права юзера
	if( ! current_user_can( 'edit_post', $post_id ) )
		return;


		if ( ! isset( $_POST['child_travelify_new_field'] ) ){
				// Все ОК. Теперь, нужно найти и сохранить данные
			$my_data = sanitize_text_field( $_POST['child_travelify_new_field'] );
			update_post_meta( $post_id, '_my_meta_value_key', $my_data );
		}


	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) ){
			delete_post_meta($post_id, $key); // удаляем поле если значение пустое
			continue;
		}

		update_post_meta( $post_id, $key, $value ); // add_post_meta() работает автоматически
	}

}
