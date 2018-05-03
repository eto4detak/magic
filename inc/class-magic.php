<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Magic' ) ) :

	/*========================================================
			*		The main Magic class
		========================================================*/
	class Magic {

		public function __construct() {

			add_action( 'after_setup_theme',          array( $this, 'setup' ) );
			add_action( 'wp_enqueue_scripts',         array( $this, 'scripts' ),       10 );
			add_action( 'after_setup_theme',  array( $this, 'content_width' ), 0 );
			add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		}

		public function setup() {

			load_theme_textdomain( 'magic', get_template_directory() . '/languages' );

			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );
			add_theme_support( 'custom-background', apply_filters( 'magic_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) ) );
			add_theme_support( 'customize-selective-refresh-widgets' );
			add_theme_support( 'custom-logo', array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			) );
			/*========================================================
					*		WooCommerce
			========================================================*/
			add_theme_support( 'woocommerce' );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
			add_theme_support( 'wc-product-gallery-zoom' );

			register_nav_menus( array(
				'menu-1' => esc_html__( 'Primary', 'magic' ),
			) );
		}

		function scripts() {
			$path_css = get_template_directory_uri() . '/assets/css/';
			$path_js = get_template_directory_uri() . '/assets/js/';

			wp_enqueue_style( 'bootstrap', 			$path_css . 'bootstrap.min.css' );
			wp_enqueue_style( 'magic-style', 		get_stylesheet_uri() );
			wp_enqueue_style( 'theme-style', 		$path_css . 'theme-style.css' );
			wp_enqueue_style( 'owl-carousel1',	$path_css . 'owl.carousel.min.css' );
			wp_enqueue_style( 'owl-carousel2', 	$path_css . 'owl.theme.default.css' );
			wp_enqueue_style( 'fontawe', 				$path_css . 'font-awesome.min.css' );
			wp_enqueue_style( 'test', 				$path_css . 'test.css' );

			// wp_enqueue_script( 'bootstrap-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' );
			// wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' );
			wp_enqueue_script( 'bootstrap-popper', $path_js . 'popper.min.js', array(), '20180206', true );
			wp_enqueue_script( 'bootstrap',        $path_js . 'bootstrap.min.js', array(), '20180206', true );
			wp_enqueue_script( 'magic-navigation', $path_js . 'navigation.js', array(), '20171019', true );
			wp_enqueue_script( 'owl-carousel',     $path_js . 'plugins/owl.carousel.js', array(), '20171019', true );
			wp_enqueue_script( 'magic-skip-link-focus-fix', $path_js . 'skip-link-focus-fix.js', array(), '20151215', true );
			wp_enqueue_script( 'front-end',        $path_js . 'front-end.js', array('bootstrap','slick-sidebar','owl-carousel'), '20180309', true );
			wp_enqueue_script( 'test',        $path_js . 'test.js', array(), '20180503', true );
			if ( is_active_sidebar( 'sidebar-1' ) ) 
			wp_enqueue_script( 'slick-sidebar',    $path_js . 'plugins/sticky-sidebar.js', array(), '20180309', true );
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		function content_width() {

			$GLOBALS['content_width'] = apply_filters( 'magic_content_width', 640 );
		}

		function widgets_init() {

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
				'before_widget' => '<section id="%1$s" class="widget %2$s col-sm col-12">',
				'after_widget'  => '</section>',
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
			) );
		}
		
	}
endif;

return new Magic();
