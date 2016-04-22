<?php

/**
 * estella functions and definitions
 *
 * @package estella
 */


$estella_theme = wp_get_theme();

define ( 'ESTELLA_VERSION'  , '1.0.0' );
define ( 'ESTELLA_TEMP_URI' , get_template_directory_uri() );
define ( 'ESTELLA_TEMP_DIR' , get_template_directory() );
define ( 'ESTELLA_CSS_URI'  , ESTELLA_TEMP_URI . '/css' );
define ( 'ESTELLA_JS_URI'	, ESTELLA_TEMP_URI . '/js' 	);
define ( 'ESTELLA_IMG_URI'  , ESTELLA_TEMP_URI . '/images' );


do_action( 'estella_init' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800; /* pixels */
}

if ( ! function_exists( 'estella_setup' ) ) :

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function estella_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on estella, use a find and replace
	 * to change 'estella' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'estella', get_template_directory() . '/languages' );

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
	//FOR FEATURED IMAGE
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
	    apply_filters( 'estella_add_navigation', array(
	    	'primary' => __( 'Primary Menu', 'estella' ),
	) ) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'estella_custom_background_args', array(
		'default-color' => 'e6e7e9',
		'default-image' => '',
	) ) );
	//registering image size of side-thumb

	add_image_size( 'estella-side-thumb',74,74 );

}
endif; // estella_setup
add_action( 'after_setup_theme', 'estella_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function estella_widgets_init() {
	//To register sidebar widgets
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'estella' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	//To register footer widgets
	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'estella' ),
		'id'            => 'footer-widgets',
		'description'   => __('I will show at the footer', 'estella'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );


}
add_action( 'widgets_init', 'estella_widgets_init' );

//adding my style sheet of font awesome

function estella_StylesAndScripts()
{
	/*==============================
	          STYLES
	===============================*/
	wp_register_style( 'estella-google-font', estella_font_url() );
	wp_enqueue_style( 'estella-google-font');

	wp_enqueue_style( 'estella-style', get_stylesheet_uri() );

	//including font awesome file
	wp_register_style( 'estella-font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css'  );
	wp_enqueue_style( 'estella-font-awesome' );

	//Incuding hover.css file for animation
	wp_register_style( 'estella-hover-css', get_template_directory_uri() . '/css/vendor/hover.css'  );
	wp_enqueue_style( 'estella-hover-css' );


	/*==============================
	          SCRIPTS
	===============================*/


	// Remember to comment out enqueueing of navigation.js in functions.php
	// Note jquery listed as dependancy which prompts WP to load it
	wp_enqueue_script( 'estella-navigation', get_template_directory_uri() . '/js/navigation-custom.js', array('jquery') );
	wp_enqueue_script( 'estella-modernizr', get_template_directory_uri() . '/js/modernizr.js' );
	wp_enqueue_script( 'estella-REM-unit-polyfill', get_template_directory_uri() . '/js/rem.js' ,false,false,true );
	wp_enqueue_script( 'estella-slick', get_template_directory_uri() . '/js/slick.js' ,false, false, true );
	wp_enqueue_script( 'estella-main', get_template_directory_uri() . '/js/main.js' ,false,false,true );

	wp_enqueue_script( 'estella-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'estella-comment-reply' );
	}




}
add_action( 'wp_enqueue_scripts', 'estella_StylesAndScripts' );




/**
 * As per new instruction
 * @link(  https://wordpress.slack.com/archives/themereview/p1427997201001885, link)
 */
function estella_filter_options_id() {
  return 'estella_option_tree';
}
add_filter( 'ot_options_id', 'estella_filter_options_id' );



/*==============================
          FILE INCLUDES
===============================*/

//Custom Functions
require get_template_directory() . '/inc/custom-functions.php';

do_action( 'cosparell_files_load' );

//Admin Folder
require get_template_directory() . '/lib/admin/admin.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Load recent post file
 */
require get_template_directory() .'/inc/recent-posts.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Breadcrumb
 */
require get_template_directory() . '/lib/breadcrumb.php';

/**
 * Social Links
 */
require get_template_directory() . '/lib/admin/social-links.php';
/**
 * Social widgets
 */
require get_template_directory() . '/lib/admin/social-widget.php';


add_action( 'estella_files_load' , 'estella_load_extras' );

function estella_load_extras()
{
	$file = ESTELLA_TEMP_DIR . '/pro/estella-pro.php';

	if (file_exists($file)) {
		define( 'ESTELLA_PRO', true );
	    require_once $file;
	}
}


do_action( 'estella_files_load' );

