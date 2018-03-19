<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "magic_optin";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Sample Options', 'magic' ),
        'page_title'           => esc_html__( 'Sample Options', 'magic' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );

        Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'magic' ),
        'id'               => 'general-section',
        'desc'             => esc_html__( 'General Settings: ', 'magic' ),
        'fields'           => array(
          array(
            'id'       => 'footer-copy',
            'type'     => 'text',
            'title'    => esc_html__('Footer Copy', 'magic'),
            'default'  => esc_html__('Site was create in 2017', 'magic') 
          ),
          array(
            'id'       => 'header-title',
            'type'     => 'text',
            'title'    => esc_html__('header Copy', 'magic'),
            'default'  => esc_html__('Site and WooComerce', 'magic') 
          ),
        )
    ) );


/*========================================================
      * [Page Options]
     * Add page options site
========================================================*/
$true_page = 'myparamet';
$gr_options_for_page = 'm_options_main';
$opions_in_db = 'true_options';
$opions_in_db_address = 'magic_options_address';
add_action( 'admin_menu', 'add_page_options' );
function add_page_options() {
  global $true_page;
  $page =  add_menu_page( __( 'Magic Options', 'magic' ), __( 'Magic', 'magic' ), '', 'magic_page_slug', NULL, NULL,20 );
add_submenu_page( 'magic_page_slug', __('Основное доп. меню', 'magic' ), __('Мое основное меню', 'magic' ), 'manage_options', $true_page,'magic_display_submenu1');
add_submenu_page( 'magic_page_slug', __('Мое подменю', 'magic' ), __('Страница настроек моего подменю', 'magic' ), 'manage_options', 'my-secondary-slug', 'magic_display_submenu2');
}

function magic_display_submenu1(){
  global $true_page;
  global $gr_options_for_page;
  ?><div class="wrap">
    <h2>Дополнительные параметры сайта</h2>
    <form  method="post" enctype="multipart/form-data" action="options.php">
      <?php 
      settings_fields($gr_options_for_page); // меняем под себя только здесь (название настроек)
      echo "<div class='company-info'>";
      do_settings_sections($true_page);
      echo "</div>";
      ?>
      <p class="submit">  
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
      </p>
    </form>
  </div><?php
}
function magic_display_submenu2(){
  echo '<div class="wrap">';
    echo '<h2>'. get_admin_page_title() .'</h2>';
  echo '</div>';
}

/*
 * Регистрируем настройки
 * Мои настройки будут храниться в базе под названием true_options (это также видно в предыдущей функции)
 */
function true_option_settings() {
  global $true_page;
  global $gr_options_for_page;
  global $opions_in_db;
  global $opions_in_db_address;

  // get_template_directory() . '/inc/customizer.php';
  wp_register_script( 'admin-magic-script', get_template_directory() . '/assets/js/admin-magic.js') ;
  wp_register_style('admin-magic-style', get_template_directory() . '/assets/css/admin-magic.css');

  register_setting( $gr_options_for_page, $opions_in_db, 'true_validate_settings' ); // true_options
  register_setting( $gr_options_for_page, $opions_in_db_address, 'true_validate_settings' ); // true_options

  // Добавляем секцию
  add_settings_section( 'true_section_1', 'Текстовые поля ввода', '', $true_page );
 
  // Создадим текстовое поле в первой секции
  $true_field_params = array(
    'type'      => 'text', // тип
    'id'        => 'my_text',
    'desc'      => 'Пример обычного текстового поля.', // описание
    'label_for' => 'my_text' // позволяет сделать название настройки лейблом (если не понимаете, что это, можете не использовать), по идее должно быть одинаковым с параметром id
  );
  add_settings_field( 'my_text_field', 'Текстовое поле', 'true_option_display_settings', $true_page, 'true_section_1', $true_field_params );
  $true_field_params = array(
    'type'      => 'text', // тип
    'id'        => 'company_address'
  );
  add_settings_field( 'my_text_address', 'Адреса компании<span class="dashicons dashicons-plus-alt add-company-address"></span>', 'true_option_display_settings', $true_page, 'true_section_1', $true_field_params );
 
  // Создадим textarea в первой секции
  $true_field_params = array(
    'type'      => 'textarea',
    'id'        => 'my_textarea',
    'desc'      => 'Пример большого текстового поля.'
  );
  add_settings_field( 'my_textarea_field', 'Большое текстовое поле', 'true_option_display_settings', $true_page, 'true_section_1', $true_field_params );
 
  // Добавляем вторую секцию настроек
 
  add_settings_section( 'true_section_2', 'Другие поля ввода', '', $true_page );
 
  // Создадим чекбокс
  $true_field_params = array(
    'type'      => 'checkbox',
    'id'        => 'my_checkbox',
    'desc'      => 'Пример чекбокса.'
  );
  add_settings_field( 'my_checkbox_field', 'Чекбокс', 'true_option_display_settings', $true_page, 'true_section_2', $true_field_params );
 
  // Создадим выпадающий список
  $true_field_params = array(
    'type'      => 'select',
    'id'        => 'my_select',
    'desc'      => 'Пример выпадающего списка.',
    'vals'    => array( 'val1' => 'Значение 1', 'val2' => 'Значение 2', 'val3' => 'Значение 3')
  );
  add_settings_field( 'my_select_field', 'Выпадающий список', 'true_option_display_settings', $true_page, 'true_section_2', $true_field_params );
 
  // Создадим радио-кнопку
  $true_field_params = array(
    'type'      => 'radio',
    'id'      => 'my_radio',
    'vals'    => array( 'val1' => 'Значение 1', 'val2' => 'Значение 2', 'val3' => 'Значение 3')
  );
  add_settings_field( 'my_radio', 'Радио кнопки', 'true_option_display_settings', $true_page, 'true_section_2', $true_field_params );
 
}
add_action( 'admin_init', 'true_option_settings' );


/*
 * Функция отображения полей ввода
 * Здесь задаётся HTML и PHP, выводящий поля
 */
function true_option_display_settings($args) {
  extract( $args );
  global $opions_in_db;
  global $opions_in_db_address;
 
  $o = get_option( $opions_in_db );
  $o_address = get_option( $opions_in_db_address );
 
  switch ( $type ) {  
    case 'text':  
      if($id === 'company_address')
      {
       $input = '
        <span class="item-address">
        <input type="text" id=' . $id . ' name="'. $opions_in_db_address .'[]" value="%s">
        <span class="dashicons dashicons-trash remove-company-address"></span>
        </span>
        ';
          if ( is_array( $o_address ) ) {
            foreach ( $o_address as $addr ) {
             printf( $input, esc_attr( $addr ) );
            }
          } else {
           printf( $input, esc_attr( $o_address ) );
          }

      }else{
      $o[$id] = esc_attr( stripslashes($o[$id]) );
      echo "<input class='regular-text' type='text' id='$id' name='" . $opions_in_db . "[$id]' value='$o[$id]' />";  
      echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""; 
      }
    break;
    case 'textarea':  
      $o[$id] = esc_attr( stripslashes($o[$id]) );
      echo "<textarea class='code large-text' cols='50' rows='10' type='text' id='$id' name='" . $opions_in_db . "[$id]'>$o[$id]</textarea>";  
      echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
    break;
    case 'checkbox':
      $checked = ($o[$id] == 'on') ? " checked='checked'" :  '';  
      echo "<label><input type='checkbox' id='$id' name='" . $opions_in_db . "[$id]' $checked /> ";  
      echo ($desc != '') ? $desc : "";
      echo "</label>";  
    break;
    case 'select':
      echo "<select id='$id' name='" . $opions_in_db . "[$id]'>";
      foreach($vals as $v=>$l){
        $selected = ($o[$id] == $v) ? "selected='selected'" : '';  
        echo "<option value='$v' $selected>$l</option>";
      }
      echo ($desc != '') ? $desc : "";
      echo "</select>";  
    break;
    case 'radio':
      echo "<fieldset>";
      foreach($vals as $v=>$l){
        $checked = ($o[$id] == $v) ? "checked='checked'" : '';  
        echo "<label><input type='radio' name='" . $opions_in_db . "[$id]' value='$v' $checked />$l</label><br />";
      }
      echo "</fieldset>";  
    break; 
  }
}

function true_validate_settings($input) {
  foreach($input as $k => $v) {
    $valid_input[$k] = trim($v);
    if($valid_input[$k] === '')
    {
      unset ($valid_input[$k]);
    }
    /* Вы можете включить в эту функцию различные проверки значений, например
    if(! задаем условие ) { // если не выполняется
      $valid_input[$k] = ''; // тогда присваиваем значению пустую строку
    }
    */
  }
  return $valid_input;
}
add_action( 'admin_enqueue_scripts', 'newscript' );
function newscript($hook){
  if( is_admin())
    {
      wp_enqueue_style( 'admin-magic1', get_template_directory_uri() . '/assets/css/admin-magic.css' );
      wp_enqueue_script( 'admin-magic2', get_template_directory_uri() . '/assets/js/admin-magic.js', array(), '20171024', true  );
    }
}
 /*========================================================
   *  [ / Page Options]
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


