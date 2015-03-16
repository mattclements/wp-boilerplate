<?php
/**
 * Boilerplate functions and definitions
 *
 * @package Boilerplate
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width))
{
	$content_width = 640;
}

if (!function_exists('boilerplate_setup'))
{
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function boilerplate_setup()
	{

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Boilerplate, use a find and replace
		 * to change 'boilerplate' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'boilerplate', get_template_directory() . '/languages' );

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
		//add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'boilerplate' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'quote', 'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'boilerplate_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	}
}
add_action( 'after_setup_theme', 'boilerplate_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function boilerplate_widgets_init()
{
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'boilerplate' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
}
add_action('widgets_init', 'boilerplate_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function boilerplate_scripts()
{
	global $wp_styles;

	wp_enqueue_style('boilerplate-style', get_stylesheet_uri());

	wp_enqueue_style('boilerplate-style-ie', get_stylesheet_directory_uri()."/css/universal-IE7.css");
    $wp_styles->add_data('boilerplate-style-ie', 'conditional', 'lt IE 8' );

	if(file_exists(get_template_directory() . '/script.min.js'))
	{
		wp_enqueue_script('boilerplate-script', get_template_directory_uri().'/script.min.js', array(), filemtime(get_template_directory().'/script.min.js'), true);
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'boilerplate_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Disable Wordpress Comments in Full
 */
require get_template_directory() . '/inc/disable-comments.php';
