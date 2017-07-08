<?php
/**
 * housepress functions and definitions
 *
 * @package housepress
 */

if ( ! function_exists( 'housepress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function housepress_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on housepress, use a find and replace
	 * to change 'housepress' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'housepress', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	  add_theme_support( 'post-thumbnails' );
	 // set_post_thumbnail_size( 571, 373, true );
	 // add_image_size( 'slider-thumb', 492, 318, array( 'center', 'center') ); // Homepage blog Images
	 // add_image_size( 'home-thumb', 360, 240, array( 'center', 'center') ); // Homepage blog Images
	 // add_image_size( 'portfolio-thumb', 860, 620, false ); // Archive Pages
	 // add_image_size( 'single-thumb', 860, 620, false ); // Single Pages


	

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'housepress' ),
		'secondary' => esc_html__( 'Footer Menu', 'housepress' ),
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

	/*
	 * Set Up Custom Logo
	 */
	add_theme_support( 'custom-logo', array(
	  'height'      => 50,
	  'width'       => 285,
	  'flex-height' => true,
	  'flex-width'  => true,  
	 ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'housepress_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( "custom-header", 
		array(
		'default-color' => 'ffffff',
		'default-image' => '',
			)  
		);
	add_editor_style() ;
}
endif; // housepress_setup
add_action( 'after_setup_theme', 'housepress_setup' );




/**
 * Enqueue scripts and styles.
 */
function housepress_scripts() {
	wp_enqueue_style( 'housepress-bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css' );	
	wp_enqueue_style( 'housepress-style', get_stylesheet_uri() );
	$query_args = array('family' => 'Droid+Serif:400,700');
	wp_register_style( 'housepress-google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
	wp_enqueue_style( 'housepress-google-fonts' );

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'housepress-nav', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0.0', true );
	wp_enqueue_script( 'housepress-bootstrap-min', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'housepress-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '1.0.0', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'housepress_scripts' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! isset( $content_width ) ) $content_width = 900;
function housepress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'housepress_content_width', 640 );

}
add_action( 'after_setup_theme', 'housepress_content_width', 0 );


function housepress_filter_front_page_template( $template ) {
    return is_home() ? '' : $template;
}
add_filter( 'front_page_template', 'housepress_filter_front_page_template' );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function housepress_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'housepress' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'housepress_widgets_init' );



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Header.
 */
require get_template_directory() . '/inc/custom-header.php';