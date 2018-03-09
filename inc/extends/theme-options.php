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
      * Page Options
     * Add page options site
    ========================================================*/
$true_page = 'myparamet';
add_action( 'admin_menu', 'add_page_options' );
// создаем подпункт меню Halloween Masks
function add_page_options() {
  global $true_page;
  $page =  add_menu_page( __( 'Magic Options', 'magic' ), __( 'Magic', 'magic' ), '', 'magic_page_slug', NULL, NULL,20 );
add_submenu_page( 'magic_page_slug', __('Основное доп. меню', 'magic' ), __('Мое основное меню', 'magic' ), 'manage_options', $true_page,'magic_display_submenu1');
add_submenu_page( 'magic_page_slug', __('Мое подменю', 'magic' ), __('Страница настроек моего подменю', 'magic' ), 'manage_options', 'my-secondary-slug', 'magic_display_submenu2');
}

function magic_display_submenu1(){
  global $true_page;
  ?><div class="wrap">
    <h2>Дополнительные параметры сайта</h2>
    <form  method="post" enctype="multipart/form-data" action="options.php">
      <?php 
      settings_fields('true_options'); // меняем под себя только здесь (название настроек)
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
    // контент страницы
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
  get_template_directory() . '/inc/customizer.php';
  wp_register_script( 'admin-magic-script', get_template_directory() . '/js/admin-magic.js') ;
  wp_register_style('admin-magic-style', get_template_directory() . '/css/admin-magic.css');

  register_setting( 'true_options', 'true_options', 'true_validate_settings' ); // true_options
  register_setting( 'true_options', 'magic_options_address', 'true_validate_settings' ); // true_options

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
 
  $option_name = 'true_options';
  $option_name_address = 'magic_options_address';
 
  $o = get_option( $option_name );
  $o_address = get_option( $option_name_address );
 
  switch ( $type ) {  
    case 'text':  
      if($id === 'company_address')
      {
       $input = '
        <span class="item-address">
        <input type="text" id=' . $id . ' name="'. $option_name_address .'[]" value="%s">
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
      echo "<input class='regular-text' type='text' id='$id' name='" . $option_name . "[$id]' value='$o[$id]' />";  
      echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""; 
      }
    break;
    case 'textarea':  
      $o[$id] = esc_attr( stripslashes($o[$id]) );
      echo "<textarea class='code large-text' cols='50' rows='10' type='text' id='$id' name='" . $option_name . "[$id]'>$o[$id]</textarea>";  
      echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
    break;
    case 'checkbox':
      $checked = ($o[$id] == 'on') ? " checked='checked'" :  '';  
      echo "<label><input type='checkbox' id='$id' name='" . $option_name . "[$id]' $checked /> ";  
      echo ($desc != '') ? $desc : "";
      echo "</label>";  
    break;
    case 'select':
      echo "<select id='$id' name='" . $option_name . "[$id]'>";
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
        echo "<label><input type='radio' name='" . $option_name . "[$id]' value='$v' $checked />$l</label><br />";
      }
      echo "</fieldset>";  
    break; 
  }
}
 
/*
 * Функция проверки правильности вводимых полей
 */
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
      wp_enqueue_style( 'admin-magic1', get_template_directory_uri() . '/css/admin-magic.css' );
      wp_enqueue_script( 'admin-magic2', get_template_directory_uri() . '/js/admin-magic.js', array(), '20171024', true  );
    }
}

/*========================================================
    *   Загружаем перевод
    ========================================================*/
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
  load_theme_textdomain('magic', get_template_directory() . '/languages');
}




