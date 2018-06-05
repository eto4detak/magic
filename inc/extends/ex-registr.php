<?php 

	add_action('register_form','show_fields');
add_action('register_post','check_fields',10,3);
add_action('user_register', 'register_fields');

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