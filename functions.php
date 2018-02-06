<?php
/**
 * magic functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package magic
 */

if ( ! function_exists( 'magic_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function magic_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on magic, use a find and replace
		 * to change 'magic' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'magic', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'magic' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'magic_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'magic_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function magic_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'magic_content_width', 640 );
}
add_action( 'after_setup_theme', 'magic_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function magic_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'magic' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'magic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Footer', 'magic' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'magic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}


add_action( 'widgets_init', 'magic_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function magic_scripts() {

	wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css' );
	wp_enqueue_style( 'magic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'header-style', get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'owl-carousel1', get_template_directory_uri() . '/css/owl.carousel.min.css' );
	wp_enqueue_style( 'owl-carousel2', get_template_directory_uri() . '/css/owl.theme.default.css' );

	wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js' );
	wp_enqueue_script( 'magic-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20171019', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array(), '20171019', true );
	wp_enqueue_script( 'owl-carou', get_template_directory_uri() . '/js/owlcarou.js', array(), '20171020', true );
	wp_enqueue_script( 'front-end', get_template_directory_uri() . '/js/front-end.js', array('bootstrap'), '20171104', true );

	wp_enqueue_script( 'magic-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'magic_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/init-tgm.php';


/**
 * Load Theme Optins
 */
require_once (dirname(__FILE__) . '/inc/theme-options.php');
/**
 *Add Metabax 
 */
require_once get_template_directory() . '/inc/class-metabox.php';

/**
 *Carbon_Fields
 */
require_once get_template_directory() . '/inc/carbon_options.php';

/**
 *Front-end
 */
require_once get_template_directory() . '/inc/frontend.php';

/**
 *woocomerce
 */
require_once get_template_directory() . '/inc/woocommerce/magic-woocommerce-template-functions.php';
require_once get_template_directory() . '/inc/woocommerce/magic-woocommerce-template-hooks.php';
require_once get_template_directory() . '/inc/woocommerce/magic-woocommerce-function.php';
// require_once get_template_directory() . '/inc/api-coupon.php';
require_once get_template_directory() . '/inc/api-rest.php';
// require_once get_template_directory() . '/inc/api-dollors-rubli.php';
// require_once get_template_directory() . '/inc/woocommerce/magic-woocomerce-rubli.php';
 // require_once get_template_directory() . 'inc/woocommerce/margin-woocomerce-add-order.php';











